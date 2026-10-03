<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Deteksi Base URL secara dinamis (mendukung http://localhost/edify, http://edify.test, atau php -S)
 */
function base_url($path = '') {
    static $base = null;
    if ($base === null) {
        $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        
        // Ambil folder script saat ini
        $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $dir = dirname($scriptName);
        $dir = ($dir === '/' || $dir === '\\' || $dir === '.') ? '' : $dir;
        
        $base = rtrim($scheme . '://' . $host . $dir, '/');
    }
    
    $cleanPath = ltrim($path, '/');
    return $cleanPath !== '' ? $base . '/' . $cleanPath : $base;
}

/**
 * URL Generator
 */
function url($path = '') {
    return base_url($path);
}

/**
 * Asset Generator
 */
function asset($path) {
    return base_url(ltrim($path, '/'));
}

/**
 * Peta route yang sama persis dengan Laravel di ruang-belajar
 */
function route($name, $params = []) {
    // Normalisasi parameter jika berupa object atau array
    $id = null;
    if (is_object($params)) {
        $id = $params->id ?? null;
    } elseif (is_array($params)) {
        $id = $params['id'] ?? (isset($params[0]) ? $params[0] : null);
    } elseif ($params !== null && !is_array($params)) {
        $id = $params;
    }

    $routes = [
        'home'                         => '/',
        'playground.index'             => '/playground',
        'playground.run'               => '/playground/run',
        'login'                        => '/login',
        'login.post'                   => '/login',
        'register'                     => '/register',
        'register.post'                => '/register',
        'logout'                       => '/logout',
        'password.request'             => '/forgot-password',
        'password.email'               => '/forgot-password',
        'password.reset'               => '/reset-password' . ($id ? '/' . $id : ''),
        'password.update'              => '/profile/password',
        'password.store'               => '/reset-password',
        'verification.notice'          => '/email/verify',
        'verification.verify'          => '/email/verify',
        'verification.send'            => '/email/verification-notification',
        'user.courses.index'           => '/courses',
        'user.courses.show'            => '/courses/' . ($id ?? '1'),
        'user.courses.enroll'          => '/courses/' . ($id ?? '1') . '/enroll',
        'user.dashboard'               => '/dashboard',
        'profile.show'                 => '/profile',
        'profile.update'               => '/profile',
        'admin.dashboard'              => '/admin',
        'admin.courses.index'          => '/admin/courses',
        'admin.courses.create'         => '/admin/courses/create',
        'admin.courses.store'          => '/admin/courses',
        'admin.courses.show'           => '/admin/courses/' . ($id ?? '1'),
        'admin.courses.edit'           => '/admin/courses/' . ($id ?? '1') . '/edit',
        'admin.courses.update'         => '/admin/courses/' . ($id ?? '1'),
        'admin.courses.destroy'        => '/admin/courses/' . ($id ?? '1') . '/delete',
        'admin.users.index'            => '/admin/users',
        'admin.users.create'           => '/admin/users/create',
        'admin.users.show'             => '/admin/users/' . ($id ?? '1'),
        'admin.users.edit'             => '/admin/users/' . ($id ?? '1') . '/edit',
        'admin.users.destroy'          => '/admin/users/' . ($id ?? '1') . '/delete',
        'admin.orders.index'           => '/admin/orders',
        'admin.settings.profile'       => '/admin/settings/profile',
        'admin.settings.profile.update'=> '/admin/settings/profile',
    ];

    $path = $routes[$name] ?? '/' . ltrim($name, '/');
    return url($path);
}

/**
 * Route::has() simulator
 */
class Route {
    public static function has($name) {
        return true;
    }
}

/**
 * Str Helper class
 */
class Str {
    public static function limit($value, $limit = 100, $end = '...') {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }
}

/**
 * App Helper class
 */
class AppHelper {
    public function getLocale() {
        return 'id';
    }
}
function app() {
    return new AppHelper();
}

/**
 * CSRF Helpers
 */
function csrf_token() {
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

function csrf_field() {
    return '<input type="hidden" name="_token" value="' . htmlspecialchars(csrf_token()) . '">';
}

/**
 * Auth Manager & Helper
 */
class AuthManager {
    public function check() {
        return !empty($_SESSION['auth_user']);
    }

    public function guest() {
        return !$this->check();
    }

    public function user() {
        if ($this->check()) {
            return (object)$_SESSION['auth_user'];
        }
        return null;
    }

    public function id() {
        $u = $this->user();
        return $u ? ($u->id ?? null) : null;
    }

    public function login($userData) {
        $_SESSION['auth_user'] = (array)$userData;
    }

    public function logout() {
        unset($_SESSION['auth_user']);
    }
}

function auth() {
    static $auth = null;
    if ($auth === null) {
        $auth = new AuthManager();
    }
    return $auth;
}

/**
 * Session Flash & Getter
 */
function session($key = null, $default = null) {
    if ($key === null) {
        return $_SESSION;
    }

    if (isset($_SESSION['flash'][$key])) {
        $val = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $val;
    }

    return $_SESSION[$key] ?? $default;
}

function set_flash($key, $val) {
    $_SESSION['flash'][$key] = $val;
}

/**
 * Old Input Helper
 */
function old($key, $default = '') {
    if (isset($_SESSION['_old_input'][$key])) {
        return $_SESSION['_old_input'][$key];
    }
    return $default;
}

/**
 * Request Helper
 */
class RequestHelper {
    public function route($param = null) {
        return $_GET['token'] ?? 'demo-reset-token-2026';
    }

    public function __get($key) {
        return $_POST[$key] ?? $_GET[$key] ?? null;
    }

    public function get($key, $default = null) {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }
}

function request($key = null, $default = null) {
    if ($key === null) {
        return new RequestHelper();
    }
    return $_POST[$key] ?? $_GET[$key] ?? $default;
}

/**
 * Error Bag Simulator
 */
class ErrorBag {
    protected $errors = [];

    public function __construct($errors = []) {
        $this->errors = $errors;
    }

    public function any() {
        return !empty($this->errors);
    }

    public function first($key = null) {
        if ($key === null) {
            $first = reset($this->errors);
            return is_array($first) ? reset($first) : $first;
        }
        return $this->errors[$key] ?? null;
    }

    public function get($key) {
        return $this->errors[$key] ?? [];
    }

    public function has($key) {
        return isset($this->errors[$key]);
    }
}

function errors() {
    $errs = $_SESSION['flash_errors'] ?? [];
    if (isset($_SESSION['flash_errors'])) {
        unset($_SESSION['flash_errors']);
    }
    return new ErrorBag($errs);
}

/**
 * View Renderer
 */
function view($viewName, $data = []) {
    extract($data);
    $viewPath = __DIR__ . '/../views/' . str_replace('.', '/', $viewName) . '.php';
    if (!file_exists($viewPath)) {
        throw new Exception("View [{$viewName}] not found at [{$viewPath}]");
    }
    
    // Objek $errors selalu tersedia di setiap view (seperti di Blade Laravel)
    if (!isset($errors)) {
        $errors = errors();
    }
    
    include $viewPath;
}

/**
 * Redirect Helper
 */
function redirect($url, $status = 302) {
    header("Location: " . $url, true, $status);
    exit;
}
