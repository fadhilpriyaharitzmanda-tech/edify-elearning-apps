<?php

/**
 * ====================================================================
 * EDIFY - Native PHP Application
 * 100% Native Replica of ruang-belajar (Zero Framework Dependencies)
 * ====================================================================
 */

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/execution.php';

// Resolusi path request saat ini
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$baseDir    = str_replace('\\', '/', dirname($scriptName));
$baseDir    = ($baseDir === '/' || $baseDir === '\\' || $baseDir === '.') ? '' : $baseDir;

// Hilangkan query string
$path = parse_url($requestUri, PHP_URL_PATH);

// Hilangkan folder base jika ada (contoh: /edify/courses -> /courses)
if ($baseDir !== '' && strpos($path, $baseDir) === 0) {
    $path = substr($path, strlen($baseDir));
}

// Fallback: jika lewat ?route=...
if (isset($_GET['route'])) {
    $path = '/' . ltrim($_GET['route'], '/');
}

$path = '/' . trim($path, '/');
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if (isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']);
}

// ====================================================================
// ACTION HANDLERS (POST / PUT / PATCH / DELETE)
// ====================================================================

// 1. Python Code Execution API (Sandbox)
if ($path === '/playground/run') {
    while (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Type: application/json; charset=utf-8');
    
    try {
        // Ambil data dari JSON atau form-data
        $rawInput = file_get_contents('php://input');
        $jsonData = json_decode($rawInput, true);

        $sourceCode = $jsonData['source_code'] ?? $_POST['source_code'] ?? '';
        $stdin      = $jsonData['stdin'] ?? $_POST['stdin'] ?? '';

        $service = new CodeExecutionService();
        $result  = $service->executePython($sourceCode, $stdin);

        echo json_encode($result);
    } catch (\Throwable $e) {
        echo json_encode([
            'success'        => false,
            'stdout'         => '',
            'stderr'         => 'Error Sandbox Engine: ' . $e->getMessage(),
            'status'         => 'Server Error',
            'status_id'      => 500,
            'execution_time' => '0s',
            'memory'         => '0 MB',
            'engine'         => 'Error',
        ]);
    }
    exit;
}

// 2. Authentication: Login
if ($path === '/login' && $method === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['flash_errors'] = ['email' => 'Email dan password harus diisi.'];
        redirect(route('login'));
    }

    // Cek apakah login sebagai Admin atau Pengguna Biasa
    if (str_contains(strtolower($email), 'admin')) {
        auth()->login([
            'id'    => 1,
            'name'  => 'Admin Edify',
            'email' => $email,
            'role'  => 'admin'
        ]);
        set_flash('success', 'Selamat datang di Panel Admin Edify!');
        redirect(route('admin.dashboard'));
    } else {
        auth()->login([
            'id'    => 2,
            'name'  => 'Fadhil PriyaHaritzmanda',
            'email' => $email,
            'role'  => 'student'
        ]);
        set_flash('success', 'Berhasil masuk. Selamat belajar kembali!');
        redirect(route('user.dashboard'));
    }
}

// 3. Authentication: Register
if ($path === '/register' && $method === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['flash_errors'] = ['name' => 'Semua kolom wajib diisi.'];
        redirect(route('register'));
    }

    auth()->login([
        'id'    => time(),
        'name'  => $name,
        'email' => $email,
        'role'  => 'student'
    ]);

    set_flash('success', 'Pendaftaran akun berhasil! Selamat datang di Edify.');
    redirect(route('user.dashboard'));
}

// 4. Authentication: Logout
if ($path === '/logout') {
    auth()->logout();
    set_flash('status', 'Anda telah berhasil keluar dari akun.');
    redirect(route('login'));
}

// 5. User Profile Update
if ($path === '/profile' && ($method === 'PATCH' || $method === 'POST')) {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (auth()->check()) {
        $u = (array)auth()->user();
        if ($name) $u['name'] = $name;
        if ($email) $u['email'] = $email;
        auth()->login($u);
    }
    set_flash('success', 'Informasi profil berhasil diperbarui.');
    redirect(route('profile.show'));
}

// 6. User Password Update
if (($path === '/profile/password' || $path === '/password/update') && ($method === 'PUT' || $method === 'POST')) {
    set_flash('success', 'Password Anda berhasil diperbarui.');
    redirect(route('profile.show'));
}

// 7. Course Enrollment
if (preg_match('#^/courses/([0-9]+)/enroll$#', $path, $matches) && $method === 'POST') {
    $courseId = $matches[1];
    if (!auth()->check()) {
        auth()->login([
            'id'    => 2,
            'name'  => 'Fadhil PriyaHaritzmanda',
            'email' => 'fadhilpriyaharitzmanda@gmail.com',
            'role'  => 'student'
        ]);
    }
    set_flash('success', 'Selamat! Anda berhasil terdaftar di kursus ini.');
    redirect(route('user.courses.show', $courseId));
}

// 8. Forgot Password & Reset Password Handlers
if ($path === '/forgot-password' && $method === 'POST') {
    set_flash('status', 'Tautan untuk mereset kata sandi telah dikirim ke alamat email Anda.');
    redirect(route('password.request'));
}

if ($path === '/reset-password' && $method === 'POST') {
    set_flash('status', 'Kata sandi berhasil direset! Silakan masuk menggunakan kata sandi baru.');
    redirect(route('login'));
}

if ($path === '/email/verification-notification' && $method === 'POST') {
    set_flash('status', 'verification-link-sent');
    redirect(route('verification.notice'));
}

// ====================================================================
// VIEW ROUTING (GET)
// ====================================================================

// Beranda / Landing Page (100% Mirip ruang-belajar user.index)
if ($path === '/' || $path === '') {
    $popularCourses = DataProvider::getCourses();
    view('user.index', compact('popularCourses'));
    exit;
}

// Python Code Playground & Sandbox
if ($path === '/playground') {
    $defaultCode = <<<'PYTHON'
# ========================================================
# Selamat Datang di Edify Python Playground & Sandbox 🚀
# ========================================================

print("Hello World")
PYTHON;

    view('playground.index', compact('defaultCode'));
    exit;
}

// User: Katalog Kursus
if ($path === '/courses') {
    $allCourses = DataProvider::getCourses();
    $search     = strtolower(trim($_GET['search'] ?? ''));
    $category   = strtolower(trim($_GET['category'] ?? ''));
    $priceType  = strtolower(trim($_GET['price'] ?? ''));

    $courses = array_filter($allCourses, function($c) use ($search, $category, $priceType) {
        if ($search !== '' && !str_contains(strtolower($c->title), $search) && !str_contains(strtolower($c->description), $search)) {
            return false;
        }
        if ($category !== '' && strtolower($c->category) !== $category) {
            return false;
        }
        if ($priceType === 'free' && $c->price > 0) {
            return false;
        }
        if ($priceType === 'paid' && $c->price == 0) {
            return false;
        }
        return true;
    });

    view('user.courses.index', compact('courses'));
    exit;
}

// User: Detail Kursus
if (preg_match('#^/courses/([0-9]+)$#', $path, $matches)) {
    $courseId = $matches[1];
    $course   = DataProvider::getCourseById($courseId);
    $isEnrolled = false;
    view('user.courses.show', compact('course', 'isEnrolled'));
    exit;
}

// User Dashboard
if ($path === '/dashboard') {
    if (!auth()->check()) {
        auth()->login([
            'id'    => 2,
            'name'  => 'Fadhil PriyaHaritzmanda',
            'email' => 'fadhilpriyaharitzmanda@gmail.com',
            'role'  => 'student'
        ]);
    }
    view('user.dashboard.index');
    exit;
}

// User Profile
if ($path === '/profile') {
    if (!auth()->check()) {
        auth()->login([
            'id'    => 2,
            'name'  => 'Fadhil PriyaHaritzmanda',
            'email' => 'fadhilpriyaharitzmanda@gmail.com',
            'role'  => 'student'
        ]);
    }
    view('user.profile.index');
    exit;
}

// Auth: Login
if ($path === '/login') {
    view('auth.login');
    exit;
}

// Auth: Register
if ($path === '/register') {
    view('auth.register');
    exit;
}

// Auth: Forgot Password
if ($path === '/forgot-password') {
    view('auth.forgot-password');
    exit;
}

// Auth: Reset Password
if (str_starts_with($path, '/reset-password')) {
    $request = request();
    view('auth.reset-password', compact('request'));
    exit;
}

// Auth: Verify Email
if ($path === '/email/verify') {
    view('auth.verify-email');
    exit;
}

// ====================================================================
// ADMIN PANEL ROUTES
// ====================================================================

// Otomatis pastikan session admin saat membuka admin panel
if (str_starts_with($path, '/admin')) {
    if (!auth()->check() || (auth()->user()->role ?? '') !== 'admin') {
        auth()->login([
            'id'    => 1,
            'name'  => 'Admin Edify',
            'email' => 'admin@edify.app',
            'role'  => 'admin'
        ]);
    }
}

// Admin: Dashboard
if ($path === '/admin' || $path === '/admin/dashboard') {
    $totalUsers    = count(DataProvider::getUsers());
    $totalCourses  = count(DataProvider::getCourses());
    $totalOrders   = count(DataProvider::getOrders());
    $totalRevenue  = 426000;
    $recentUsers   = DataProvider::getUsers();
    $recentOrders  = DataProvider::getOrders();

    view('admin.dashboard.index', compact(
        'totalUsers',
        'totalCourses',
        'totalOrders',
        'totalRevenue',
        'recentUsers',
        'recentOrders'
    ));
    exit;
}

// Admin: Manajemen Kursus
if ($path === '/admin/courses') {
    $courses           = DataProvider::getCourses();
    $totalCourses      = count($courses);
    $publishedCourses  = count($courses);
    $draftCourses      = 0;
    $totalEnrollments  = 6520;

    view('admin.courses.index', compact(
        'courses',
        'totalCourses',
        'publishedCourses',
        'draftCourses',
        'totalEnrollments'
    ));
    exit;
}

// Admin: Tambah Kursus Action / Fallback
if ($path === '/admin/courses/create') {
    set_flash('info', 'Fitur buat kursus baru akan segera tersedia di pembaruan rilis.');
    redirect(route('admin.courses.index'));
}

// Admin: Manajemen Pengguna
if ($path === '/admin/users') {
    $users = DataProvider::getUsers();
    view('admin.users.index', compact('users'));
    exit;
}

// Admin: Tambah Pengguna Action / Fallback
if ($path === '/admin/users/create') {
    set_flash('info', 'Form tambah pengguna baru akan segera tersedia.');
    redirect(route('admin.users.index'));
}

// Admin: Manajemen Transaksi (Orders)
if ($path === '/admin/orders') {
    $orders        = DataProvider::getOrders();
    $totalOrders   = count($orders);
    $totalRevenue  = 426000;
    $pendingOrders = 0;

    view('admin.orders.index', compact(
        'orders',
        'totalOrders',
        'totalRevenue',
        'pendingOrders'
    ));
    exit;
}

// Admin: Pengaturan Profil
if ($path === '/admin/settings/profile') {
    view('admin.settings.profile');
    exit;
}

// Fallback 404
http_response_code(404);
echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>404 Tidak Ditemukan - Edify</title>";
echo "<style>body{font-family:'Plus Jakarta Sans',sans-serif;background:#09090b;color:#f9fafb;display:flex;align-items:center;justify-content:center;height:100vh;margin:0;flex-direction:column;text-align:center;} a{color:#6366f1;text-decoration:none;margin-top:1rem;display:inline-block;padding:0.5rem 1.25rem;border:1px solid #6366f1;border-radius:9999px;font-weight:600;}</style></head>";
echo "<body><h1>404 - Halaman Tidak Ditemukan</h1><p>Halaman [".htmlspecialchars($path)."] tidak ditemukan di server Edify.</p>";
echo "<a href='".url('/')."'>Kembali ke Beranda</a></body></html>";
