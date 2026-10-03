<?php

/**
 * Data Storage & Catalog Mock Provider (Native PHP)
 */

class DataProvider {

    public static function getCourses() {
        return [
            (object)[
                'id'                => 1,
                'tag_filter'        => 'html-css',
                'title'             => 'Dasar HTML & Struktur Web Modern',
                'category'          => 'HTML & CSS',
                'description'       => 'Pahami pondasi website modern dari nol, elemen semantik HTML5, struktur formulir interaktif, aksesibilitas a11y, dan pembuatan website portofolio pertama Anda.',
                'image'             => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80',
                'price'             => 0,
                'original'          => 0,
                'duration'          => '14',
                'level'             => 'Pemula',
                'status'            => 'published',
                'enrollments_count' => 1420,
                'icon'              => 'code',
                'instructor'        => (object)['name' => 'Alena Lubin', 'role' => 'Frontend Specialist'],
                'outcomes'          => [
                    'Memahami sintaks semantik HTML5 terkini',
                    'Menyusun hierarki konten dan struktur heading',
                    'Membuat form input interaktif dan validasi',
                    'Menerapkan SEO dasar & aksesibilitas web'
                ],
                'modules'           => [
                    (object)[
                        'title'   => 'Modul 1: Pengenalan HTML & Dokumen Web',
                        'lessons' => [
                            (object)['title' => 'Struktur Dasar HTML Dokumen & Tag Penting'],
                            (object)['title' => 'Bekerja dengan Teks, List, dan Link Anchor'],
                            (object)['title' => 'Menambahkan Gambar, Audio, dan Video'],
                        ]
                    ],
                    (object)[
                        'title'   => 'Modul 2: Semantic Elements & Formulir',
                        'lessons' => [
                            (object)['title' => 'Elemen Semantik: Header, Nav, Main, Footer'],
                            (object)['title' => 'Formulir: Input, Label, Textarea, dan Select'],
                            (object)['title' => 'Proyek: Membuat Halaman Profil Portofolio Sederhana'],
                        ]
                    ]
                ]
            ],
            (object)[
                'id'                => 2,
                'tag_filter'        => 'html-css',
                'title'             => 'Dasar CSS & Styling Responsif',
                'category'          => 'HTML & CSS',
                'description'       => 'Kuasai tata letak Flexbox & CSS Grid, tipografi responsif, custom CSS variable, animasi micro-interaction, dan review tugas desain langsung dari mentor.',
                'image'             => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
                'price'             => 0,
                'original'          => 0,
                'duration'          => '18',
                'level'             => 'Pemula',
                'status'            => 'published',
                'enrollments_count' => 1250,
                'icon'              => 'palette',
                'instructor'        => (object)['name' => 'Cristofer Kenter', 'role' => 'Product Designer'],
                'outcomes'          => [
                    'Menguasai Box Model, Margin, Padding & Border',
                    'Membuat layout responsif dengan Flexbox & CSS Grid',
                    'Menggunakan Custom Properties (CSS Variables)',
                    'Menerapkan animasi transisi mikro interaktif'
                ],
                'modules'           => [
                    (object)[
                        'title'   => 'Modul 1: Prinsip Tata Letak CSS',
                        'lessons' => [
                            (object)['title' => 'CSS Box Model dan Positioning Element'],
                            (object)['title' => 'Flexbox Architecture untuk Layout Komponen'],
                            (object)['title' => 'CSS Grid System untuk Layout Halaman Responsif'],
                        ]
                    ],
                    (object)[
                        'title'   => 'Modul 2: Estetika Visual & Animasi',
                        'lessons' => [
                            (object)['title' => 'Variabel Warna HSL & Glassmorphism'],
                            (object)['title' => 'Keyframe Animations & Micro-transitions'],
                            (object)['title' => 'Proyek: Membangun Landing Page Modern Responsif'],
                        ]
                    ]
                ]
            ],
            (object)[
                'id'                => 3,
                'tag_filter'        => 'javascript',
                'title'             => 'Dasar JavaScript & Interaktivitas Web',
                'category'          => 'Teknologi',
                'description'       => 'Pelajari variabel, fungsi, logika kondisi, perulangan, manipulasi DOM, dan event interaktif halaman web untuk pemula.',
                'image'             => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
                'price'             => 99000,
                'original'          => 199000,
                'duration'          => '16',
                'level'             => 'Menengah',
                'status'            => 'published',
                'enrollments_count' => 980,
                'icon'              => 'braces',
                'instructor'        => (object)['name' => 'James Kenter', 'role' => 'Engineering Manager'],
                'outcomes'          => [
                    'Menguasai dasar sintaks ES6+ modern',
                    'Memanipulasi DOM dan menangani Event Listener',
                    'Bekerja dengan Async / Await & Fetch API',
                    'Membangun aplikasi Todo interaktif dengan LocalStorage'
                ],
                'modules'           => [
                    (object)[
                        'title'   => 'Modul 1: Fundamental JavaScript ES6',
                        'lessons' => [
                            (object)['title' => 'Let, Const, Tipe Data, dan Arrow Function'],
                            (object)['title' => 'Array Methods: Map, Filter, Reduce'],
                            (object)['title' => 'Destructuring dan Spread Operator'],
                        ]
                    ],
                    (object)[
                        'title'   => 'Modul 2: Manipulasi DOM & Asynchronous',
                        'lessons' => [
                            (object)['title' => 'QuerySelector dan Event Handling Dinamis'],
                            (object)['title' => 'Promises, Async/Await, dan Fetch Data API'],
                            (object)['title' => 'Proyek: Interactivity & Dynamic Shopping Cart'],
                        ]
                    ]
                ]
            ],
            (object)[
                'id'                => 4,
                'tag_filter'        => 'tools',
                'title'             => 'Dasar Git & GitHub untuk Pemula',
                'category'          => 'Teknologi',
                'description'       => 'Panduan lengkap version control, commit alur kerja, percabangan branch, serta kolaborasi repositori proyek di GitHub.',
                'image'             => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=800&q=80',
                'price'             => 0,
                'original'          => 0,
                'duration'          => '6',
                'level'             => 'Pemula',
                'status'            => 'published',
                'enrollments_count' => 1100,
                'icon'              => 'git-branch',
                'instructor'        => (object)['name' => 'Phillip Bothman', 'role' => 'Founder & CEO'],
                'outcomes'          => [
                    'Instalasi dan konfigurasi Git di terminal',
                    'Alur kerja Git: Init, Add, Commit, Log, Status',
                    'Bekerja dengan Branch, Checkout, dan Merge Conflict',
                    'Push repositori dan Pull Request di GitHub'
                ],
                'modules'           => [
                    (object)[
                        'title'   => 'Modul 1: Dasar Version Control',
                        'lessons' => [
                            (object)['title' => 'Memahami Konsep Version Control System'],
                            (object)['title' => 'Tracking Perubahan dengan Git Commit'],
                        ]
                    ],
                    (object)[
                        'title'   => 'Modul 2: Kolaborasi GitHub',
                        'lessons' => [
                            (object)['title' => 'Branching Strategy dan Git Merge'],
                            (object)['title' => 'Remote Repository & GitHub Workflow'],
                        ]
                    ]
                ]
            ],
            (object)[
                'id'                => 5,
                'tag_filter'        => 'backend',
                'title'             => 'Dasar Pemrograman PHP & MySQL',
                'category'          => 'PHP & Database',
                'description'       => 'Arsitektur backend dinamis, manajemen query database MySQL, autentikasi sesi aman, operasi CRUD, dan live code review mentor praktisi.',
                'image'             => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80',
                'price'             => 129000,
                'original'          => 249000,
                'duration'          => '26',
                'level'             => 'Menengah',
                'status'            => 'published',
                'enrollments_count' => 840,
                'icon'              => 'database',
                'instructor'        => (object)['name' => 'James Kenter', 'role' => 'Engineering Manager'],
                'outcomes'          => [
                    'Menguasai struktur PHP Native 8.3 & Sintaks OOP',
                    'Menghubungkan aplikasi ke MySQL dengan PDO aman',
                    'Menerapkan Operasi CRUD (Create, Read, Update, Delete)',
                    'Manajemen sesi autentikasi pengguna dan keamanan data'
                ],
                'modules'           => [
                    (object)[
                        'title'   => 'Modul 1: PHP Native Fundamentals',
                        'lessons' => [
                            (object)['title' => 'Variabel, Superglobals, Form Handling POST/GET'],
                            (object)['title' => 'Koneksi Database Relasional dengan PDO'],
                        ]
                    ],
                    (object)[
                        'title'   => 'Modul 2: CRUD & Autentikasi',
                        'lessons' => [
                            (object)['title' => 'Prepared Statements & Query Sanitasi'],
                            (object)['title' => 'Sistem Login, Registrasi, dan Session Guard'],
                        ]
                    ]
                ]
            ],
            (object)[
                'id'                => 6,
                'tag_filter'        => 'design',
                'title'             => 'Dasar UI/UX Design dengan Figma',
                'category'          => 'Desain',
                'description'       => 'Fundamental perancangan antarmuka aplikasi, wireframe, hierarchy visual, auto-layout, dan pembuatan prototype interaktif.',
                'image'             => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=800&q=80',
                'price'             => 99000,
                'original'          => 199000,
                'duration'          => '14',
                'level'             => 'Pemula',
                'status'            => 'published',
                'enrollments_count' => 930,
                'icon'              => 'layout-template',
                'instructor'        => (object)['name' => 'Cristofer Kenter', 'role' => 'Product Designer'],
                'outcomes'          => [
                    'Prinsip UI Design: Tipografi, Skema Warna, Whitespace',
                    'Mastering Figma Frames, Components, dan Auto-layout',
                    'Membuat Design System & Style Library reusable',
                    'Prototyping interaktif dengan smart animate'
                ],
                'modules'           => [
                    (object)[
                        'title'   => 'Modul 1: Wireframing & Komponen Figma',
                        'lessons' => [
                            (object)['title' => 'Alur User Research & Low-fidelity Wireframe'],
                            (object)['title' => 'Auto-layout & Responsive Components'],
                        ]
                    ],
                    (object)[
                        'title'   => 'Modul 2: High Fidelity & Prototyping',
                        'lessons' => [
                            (object)['title' => 'Color Tokens, Typography & Iconography'],
                            (object)['title' => 'Smart Animate & Interactive Micro-animations'],
                        ]
                    ]
                ]
            ],
        ];
    }

    public static function getCourseById($id) {
        $courses = self::getCourses();
        foreach ($courses as $c) {
            if ($c->id == $id) {
                return $c;
            }
        }
        return $courses[0] ?? null;
    }

    public static function getUsers() {
        return [
            (object)[
                'id'         => 1,
                'name'       => 'Fadhil PriyaHaritzmanda',
                'email'      => 'fadhilpriyaharitzmanda@gmail.com',
                'role'       => 'admin',
                'status'     => 'active',
                'courses'    => [1, 3],
                'created_at' => (object)['format' => fn($f) => '12 Jan 2026'],
            ],
            (object)[
                'id'         => 2,
                'name'       => 'Sarah Chen',
                'email'      => 'sarah.chen@tech.io',
                'role'       => 'student',
                'status'     => 'active',
                'courses'    => [1, 2, 5],
                'created_at' => (object)['format' => fn($f) => '15 Jan 2026'],
            ],
            (object)[
                'id'         => 3,
                'name'       => 'Budi Santoso',
                'email'      => 'budi.santoso@code.id',
                'role'       => 'student',
                'status'     => 'active',
                'courses'    => [3, 5],
                'created_at' => (object)['format' => fn($f) => '18 Jan 2026'],
            ],
            (object)[
                'id'         => 4,
                'name'       => 'Emily Rodriguez',
                'email'      => 'emily.r@design.com',
                'role'       => 'student',
                'status'     => 'active',
                'courses'    => [2, 6],
                'created_at' => (object)['format' => fn($f) => '22 Jan 2026'],
            ],
            (object)[
                'id'         => 5,
                'name'       => 'Marcus Johnson',
                'email'      => 'marcus.j@datahub.org',
                'role'       => 'student',
                'status'     => 'active',
                'courses'    => [1, 4],
                'created_at' => (object)['format' => fn($f) => '01 Feb 2026'],
            ],
        ];
    }

    public static function getOrders() {
        $courses = self::getCourses();
        return [
            (object)[
                'id'         => 'ORD-2026-001',
                'user'       => (object)['name' => 'Sarah Chen', 'email' => 'sarah.chen@tech.io'],
                'course'     => $courses[2],
                'amount'     => 99000,
                'status'     => 'paid',
                'created_at' => '02 Feb 2026',
            ],
            (object)[
                'id'         => 'ORD-2026-002',
                'user'       => (object)['name' => 'Budi Santoso', 'email' => 'budi.santoso@code.id'],
                'course'     => $courses[4],
                'amount'     => 129000,
                'status'     => 'paid',
                'created_at' => '05 Feb 2026',
            ],
            (object)[
                'id'         => 'ORD-2026-003',
                'user'       => (object)['name' => 'Emily Rodriguez', 'email' => 'emily.r@design.com'],
                'course'     => $courses[5],
                'amount'     => 99000,
                'status'     => 'paid',
                'created_at' => '10 Feb 2026',
            ],
            (object)[
                'id'         => 'ORD-2026-004',
                'user'       => (object)['name' => 'Fadhil PriyaHaritzmanda', 'email' => 'fadhilpriyaharitzmanda@gmail.com'],
                'course'     => $courses[2],
                'amount'     => 99000,
                'status'     => 'paid',
                'created_at' => '14 Feb 2026',
            ],
        ];
    }
}
