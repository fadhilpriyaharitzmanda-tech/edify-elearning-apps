<?php $title = $course->title ?? 'Detail Kursus'; ?>
<?php $meta_description = Str::limit($course->description ?? '', 155); ?>

<?php ob_start(); ?>

<style>
    /* ============================================================
       Responsive Course Detail Page Styles
    ============================================================ */
    .course-detail-container {
        padding-top: 2rem;
        padding-bottom: 4.5rem;
    }
    .course-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--color-text-muted);
        margin-bottom: 2rem;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 0.25rem;
    }
    .course-breadcrumb a {
        color: var(--color-text-muted);
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .course-breadcrumb a:hover {
        color: var(--color-primary);
    }
    .course-breadcrumb span.current {
        color: var(--color-text);
        font-weight: 500;
        max-width: 320px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Main 2-Column Responsive Grid */
    .course-detail-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 2.5rem;
        align-items: start;
    }

    .course-main-content {
        min-width: 0;
    }

    .course-category-badge {
        display: inline-block;
        font-size: 0.75rem;
        color: var(--color-primary);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 0.75rem;
        background: rgba(99, 102, 241, 0.08);
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
    }

    .course-title-text {
        font-size: clamp(1.5rem, 3.5vw, 2.25rem);
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 1rem;
        color: var(--color-text);
        word-break: break-word;
    }

    .course-desc-text {
        font-size: 1.025rem;
        color: var(--color-text-muted);
        line-height: 1.7;
        margin-bottom: 1.75rem;
    }

    /* Responsive Meta Stats Bar */
    .course-meta-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 1.25rem;
        margin-bottom: 2rem;
        padding: 1rem 0;
        border-top: 1px solid var(--color-border);
        border-bottom: 1px solid var(--color-border);
    }
    .course-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.875rem;
        color: var(--color-text-muted);
    }
    .course-meta-item i {
        color: var(--color-primary);
    }

    /* Instructor */
    .course-instructor-card {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        margin-bottom: 2rem;
        padding: 0.85rem 1.15rem;
        background: var(--color-bg-alt, rgba(99, 102, 241, 0.03));
        border: 1px solid var(--color-border);
        border-radius: 1rem;
        width: fit-content;
        max-width: 100%;
    }
    .course-instructor-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary), #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* What you'll learn box */
    .course-outcomes-box {
        background: rgba(99, 102, 241, 0.04);
        border: 1px solid rgba(99, 102, 241, 0.16);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 2.25rem;
    }
    .course-outcomes-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.85rem;
    }
    .course-outcome-item {
        display: flex;
        align-items: flex-start;
        gap: 0.6rem;
        font-size: 0.9rem;
        color: var(--color-text);
        line-height: 1.5;
    }

    /* Curriculum Accordion */
    .curriculum-container {
        border: 1px solid var(--color-border);
        border-radius: var(--radius);
        overflow: hidden;
        background: var(--color-bg);
    }
    .curriculum-btn {
        width: 100%;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 0.925rem;
        font-weight: 600;
        color: var(--color-text);
        font-family: inherit;
        text-align: left;
        transition: background 0.15s ease;
    }
    .curriculum-btn:hover {
        background: rgba(99, 102, 241, 0.04);
    }

    /* Sidebar Purchase Card */
    .course-sidebar-wrapper {
        position: sticky;
        top: 5.5rem;
        z-index: 10;
    }
    .course-purchase-card {
        border: 1px solid var(--color-border);
        border-radius: 1.25rem;
        overflow: hidden;
        background: var(--color-bg);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.06);
    }
    .course-purchase-thumb {
        height: 200px;
        width: 100%;
        overflow: hidden;
        background: #0f172a;
        position: relative;
    }
    .course-purchase-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Tablet and Mobile Breakpoints */
    @media (max-width: 960px) {
        .course-detail-layout {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        .course-sidebar-wrapper {
            position: static;
            top: 0;
            order: -1; /* Display course thumbnail, price, and CTA card right at top for mobile/tablet */
            max-width: 540px;
            margin: 0 auto;
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .course-detail-container {
            padding-top: 1.25rem;
            padding-bottom: 3.5rem;
        }
        .course-outcomes-grid {
            grid-template-columns: 1fr;
            gap: 0.65rem;
        }
        .course-meta-bar {
            gap: 0.75rem 1.25rem;
            padding: 0.85rem 0;
        }
        .course-purchase-thumb {
            height: 180px;
        }
    }
</style>

<div class="container-md course-detail-container">

    <!-- Breadcrumb (Horizontally Scrollable on Mobile) -->
    <nav class="course-breadcrumb" aria-label="Breadcrumb">
        <a href="<?= url('/') ?>">Beranda</a>
        <span>/</span>
        <a href="<?= route('user.courses.index') ?>">Kursus</a>
        <span>/</span>
        <span class="current"><?= htmlspecialchars(Str::limit($course->title ?? 'Detail', 45)) ?></span>
    </nav>

    <div class="course-detail-layout">

        <!-- LEFT: Course Detail Content -->
        <div class="course-main-content">
            <!-- Category badge -->
            <div class="course-category-badge">
                <?= htmlspecialchars($course->category ?? 'Teknologi') ?>
            </div>

            <h1 class="course-title-text">
                <?= htmlspecialchars($course->title ?? 'Judul Kursus') ?>
            </h1>

            <p class="course-desc-text">
                <?= htmlspecialchars($course->description ?? 'Deskripsi kursus ini.') ?>
            </p>

            <!-- Meta Stats -->
            <div class="course-meta-bar">
                <div class="course-meta-item">
                    <i data-lucide="users" style="width:16px;height:16px;"></i>
                    <span><?= $course->enrollments_count ?? 0 ?> pelajar</span>
                </div>
                <div class="course-meta-item">
                    <i data-lucide="clock" style="width:16px;height:16px;"></i>
                    <span><?= htmlspecialchars($course->duration ?? '10') ?> jam total</span>
                </div>
                <div class="course-meta-item">
                    <i data-lucide="bar-chart" style="width:16px;height:16px;"></i>
                    <span>Level <?= htmlspecialchars($course->level ?? 'Pemula') ?></span>
                </div>
                <div class="course-meta-item">
                    <i data-lucide="award" style="width:16px;height:16px;"></i>
                    <span>Sertifikat Resmi</span>
                </div>
            </div>

            <!-- Instructor -->
            <div class="course-instructor-card">
                <div class="course-instructor-avatar">
                    <?= strtoupper(substr($course->instructor->name ?? 'I', 0, 1)) ?>
                </div>
                <div>
                    <div style="font-size:0.75rem; color:var(--color-text-muted); text-transform:uppercase; letter-spacing:0.04em;">Instruktur Utama</div>
                    <div style="font-size:0.95rem; font-weight:700; color:var(--color-text);"><?= htmlspecialchars($course->instructor->name ?? 'Instruktur Edify') ?></div>
                </div>
            </div>

            <!-- What you'll learn -->
            <div class="course-outcomes-box">
                <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:1rem; color:var(--color-text); display:flex; align-items:center; gap:0.5rem;">
                    <i data-lucide="check-circle-2" style="width:18px;height:18px;color:#10b981;"></i>
                    <span>Yang Akan Anda Pelajari</span>
                </h2>
                <div class="course-outcomes-grid">
                    <?php $_items = $course->outcomes ?? ['Memahami konsep inti & fundamental', 'Membangun proyek nyata siap portofolio', 'Mendapatkan sertifikat resmi terverifikasi', 'Akses diskusi komunitas pembelajar']; if (!empty($_items) && (is_countable($_items) ? count($_items) > 0 : true)): foreach ($_items as $outcome): ?>
                    <div class="course-outcome-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= htmlspecialchars($outcome) ?></span>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>

            <!-- Curriculum -->
            <h2 style="font-size:1.15rem; font-weight:700; margin-bottom:1rem; color:var(--color-text);">Kurikulum Kursus</h2>
            <div class="curriculum-container">
                <?php 
                $_items = $course->modules ?? []; 
                $modCount = is_countable($_items) ? count($_items) : 0;
                if (!empty($_items) && $modCount > 0): 
                    foreach ($_items as $i => $module): 
                ?>
                <div style="<?= $i < $modCount - 1 ? 'border-bottom:1px solid var(--color-border);' : '' ?>">
                    <button type="button" class="curriculum-btn" onclick="toggleModule(<?= $i ?>)">
                        <span><?= htmlspecialchars($module->title) ?></span>
                        <i data-lucide="chevron-down" id="module-icon-<?= $i ?>" style="width:16px;height:16px;transition:transform 0.25s ease;"></i>
                    </button>
                    <div id="module-content-<?= $i ?>" style="max-height:0;overflow:hidden;transition:max-height 0.3s ease;">
                        <?php foreach ($module->lessons ?? [] as $lesson): ?>
                        <div style="display:flex;align-items:center;gap:0.75rem;padding:0.75rem 1.25rem 0.75rem 2.25rem;border-top:1px solid var(--color-border);font-size:0.85rem;color:var(--color-text-muted);">
                            <i data-lucide="play-circle" style="width:15px;height:15px;color:var(--color-primary);flex-shrink:0;"></i>
                            <span style="color:var(--color-text);"><?= htmlspecialchars($lesson->title) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; else: ?>
                <div style="padding:2rem 1.5rem; text-align:center; color:var(--color-text-muted); font-size:0.9rem;">
                    <i data-lucide="calendar" style="width:36px;height:36px;margin:0 auto 0.5rem;opacity:0.35;display:block;"></i>
                    Kurikulum kursus lengkap akan segera diperbarui.
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT: Sticky Purchase Card (Responsive on Mobile) -->
        <div class="course-sidebar-wrapper">
            <div class="course-purchase-card">
                <!-- Course thumbnail -->
                <div class="course-purchase-thumb">
                    <?php if (!empty($course->image)): ?>
                        <img src="<?= htmlspecialchars($course->image) ?>" alt="<?= htmlspecialchars($course->title ?? '') ?>">
                    <?php else: ?>
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#4f46e5,#7c3aed);display:flex;align-items:center;justify-content:center;">
                            <i data-lucide="book-open" style="width:56px;height:56px;color:rgba(255,255,255,0.75);"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <div style="padding:1.5rem;">
                    <!-- Price & Discount -->
                    <div style="margin-bottom:1.25rem;">
                        <?php if (($course->price ?? 0) > 0): ?>
                            <div style="display:flex; align-items:baseline; gap:0.5rem; flex-wrap:wrap; margin-bottom:0.35rem;">
                                <span style="font-size:1.45rem; font-weight:800; color:var(--color-text); line-height:1.2;">
                                    Rp <?= number_format($course->price, 0, ',', '.') ?>
                                </span>
                                <?php if (!empty($course->original) && $course->original > $course->price): ?>
                                    <span style="font-size:0.85rem; color:var(--color-text-muted); text-decoration:line-through;">
                                        Rp <?= number_format($course->original, 0, ',', '.') ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($course->original) && $course->original > $course->price): ?>
                                <?php $discountPct = round((($course->original - $course->price) / $course->original) * 100); ?>
                                <span style="display:inline-block; font-size:0.75rem; font-weight:700; color:#ef4444; background:rgba(239,68,68,0.1); padding:0.2rem 0.6rem; border-radius:9999px;">
                                    Hemat <?= $discountPct ?>%
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <div style="display:flex; align-items:center; gap:0.5rem;">
                                <span style="font-size:1.35rem; font-weight:800; color:#10b981; line-height:1.2;">
                                    Gratis
                                </span>
                                <span style="font-size:0.75rem; font-weight:700; color:#10b981; background:rgba(16,185,129,0.1); padding:0.2rem 0.6rem; border-radius:9999px;">
                                    100% Akses Gratis
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Enroll button -->
                    <?php if ($isEnrolled ?? false): ?>
                    <a href="#" style="display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.95rem;background:#10b981;color:#fff;border-radius:10px;font-size:0.95rem;font-weight:700;text-decoration:none;margin-bottom:0.75rem;transition:transform 0.15s,box-shadow 0.15s;box-shadow:0 4px 14px rgba(16,185,129,0.3);">
                        <span>Lanjutkan Belajar</span>
                        <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
                    </a>
                    <?php else: ?>
                    <button type="button" id="enrollBtn" onclick="handleCourseOrder(event)" style="width:100%;padding:0.95rem;background:var(--color-primary);color:#fff;border:none;border-radius:10px;font-size:0.95rem;font-weight:700;cursor:pointer;margin-bottom:0.75rem;display:flex;align-items:center;justify-content:center;gap:0.5rem;transition:all 0.2s;box-shadow:0 6px 18px rgba(99,102,241,0.35);">
                        <span><?= ($course->price ?? 0) > 0 ? 'Beli Kursus Sekarang' : 'Daftar Kursus Gratis' ?></span>
                        <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
                    </button>
                    <?php endif; ?>

                    <!-- Guarantee -->
                    <p style="text-align:center;font-size:0.78rem;color:var(--color-text-muted);margin-bottom:1.25rem;">
                        <i data-lucide="shield-check" style="width:13px;height:13px;vertical-align:-2px;color:#10b981;"></i>
                        Garansi uang kembali 7 hari tanpa syarat
                    </p>

                    <!-- Includes -->
                    <div style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.835rem;color:var(--color-text-muted);border-top:1px solid var(--color-border);padding-top:1.15rem;">
                        <div style="display:flex;align-items:center;gap:0.55rem;">
                            <i data-lucide="infinity" style="width:15px;height:15px;color:var(--color-primary);"></i>
                            <span>Akses seumur hidup 24/7</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.55rem;">
                            <i data-lucide="smartphone" style="width:15px;height:15px;color:var(--color-primary);"></i>
                            <span>Akses dari HP, tablet, dan PC</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.55rem;">
                            <i data-lucide="award" style="width:15px;height:15px;color:var(--color-primary);"></i>
                            <span>Sertifikat kelulusan terakreditasi</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.55rem;">
                            <i data-lucide="download" style="width:15px;height:15px;color:var(--color-primary);"></i>
                            <span>Source code & materi dapat diunduh</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    function toggleModule(i) {
        const content = document.getElementById('module-content-' + i);
        const icon    = document.getElementById('module-icon-' + i);
        const isOpen  = content.style.maxHeight && content.style.maxHeight !== '0px';
        document.querySelectorAll('[id^="module-content-"]').forEach(el => el.style.maxHeight = '0px');
        document.querySelectorAll('[id^="module-icon-"]').forEach(el => el.style.transform = '');
        if (!isOpen) {
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.style.transform = 'rotate(180deg)';
        }
    }

    function handleCourseOrder(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        const courseTitle = <?= json_encode($course->title ?? 'Kursus Edify') ?>;
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                text: 'Selamat! Anda telah berhasil mendaftar kursus "' + courseTitle + '".',
                confirmButtonText: 'Oke, Mengerti',
                confirmButtonColor: '#6366f1',
                background: document.documentElement.getAttribute('data-theme') === 'dark' ? '#18181b' : '#ffffff',
                color: document.documentElement.getAttribute('data-theme') === 'dark' ? '#f9fafb' : '#111827'
            });
        } else {
            alert('Selamat! Anda telah berhasil mendaftar kursus "' + courseTitle + '".');
        }
    }
</script>
<?php $extra_scripts = ($extra_scripts ?? '') . ob_get_clean(); ?>

<?php
// Render Layout
require __DIR__ . '/../../../layouts/app.php';
