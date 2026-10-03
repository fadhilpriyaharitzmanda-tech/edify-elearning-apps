<?php $title = $course->title ?? 'Detail Kursus'; ?>
<?php $meta_description = Str::limit($course->description ?? '', 155); ?>





<?php ob_start(); ?>

<div class="container-md" style="padding-top:2rem; padding-bottom:4rem;">

    <!-- Breadcrumb -->
    <nav style="display:flex; align-items:center; gap:0.5rem; font-size:0.8rem; color:var(--color-text-muted); margin-bottom:2rem;">
        <a href="<?= url('/') ?>" style="color:var(--color-text-muted); text-decoration:none;" onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='var(--color-text-muted)'">Beranda</a>
        <span>/</span>
        <a href="<?= route('user.courses.index') ?>" style="color:var(--color-text-muted); text-decoration:none;" onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='var(--color-text-muted)'">Kursus</a>
        <span>/</span>
        <span style="color:var(--color-text);"><?= Str::limit($course->title ?? 'Detail', 40) ?></span>
    </nav>

    <div style="display:grid; grid-template-columns:1fr 340px; gap:2.5rem; align-items:start;">

        <!-- LEFT: Course Detail -->
        <div>
            <!-- Category badge -->
            <div style="font-size:0.75rem; color:var(--color-primary); font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.75rem;">
                <?= $course->category ?? 'Teknologi' ?>
            </div>

            <h1 style="font-size:1.875rem; font-weight:800; line-height:1.25; margin-bottom:1rem; color:var(--color-text);">
                <?= $course->title ?? 'Judul Kursus' ?>
            </h1>

            <p style="font-size:1rem; color:var(--color-text-muted); line-height:1.7; margin-bottom:1.5rem;">
                <?= $course->description ?? 'Deskripsi kursus ini.' ?>
            </p>

            <!-- Meta -->
            <div style="display:flex; flex-wrap:wrap; gap:1.25rem; margin-bottom:2rem; padding:1rem 0; border-top:1px solid var(--color-border); border-bottom:1px solid var(--color-border);">
                <div style="display:flex;align-items:center;gap:0.375rem;font-size:0.85rem;color:var(--color-text-muted);">
                    <i data-lucide="users" style="width:15px;height:15px;"></i>
                    <?= $course->enrollments_count ?? 0 ?> pelajar
                </div>
                <div style="display:flex;align-items:center;gap:0.375rem;font-size:0.85rem;color:var(--color-text-muted);">
                    <i data-lucide="clock" style="width:15px;height:15px;"></i>
                    <?= $course->duration ?? '10' ?> jam
                </div>
                <div style="display:flex;align-items:center;gap:0.375rem;font-size:0.85rem;color:var(--color-text-muted);">
                    <i data-lucide="bar-chart" style="width:15px;height:15px;"></i>
                    <?= $course->level ?? 'Pemula' ?>
                </div>
                <div style="display:flex;align-items:center;gap:0.375rem;font-size:0.85rem;color:var(--color-text-muted);">
                    <i data-lucide="award" style="width:15px;height:15px;"></i>
                    Sertifikat tersedia
                </div>
            </div>

            <!-- Instructor -->
            <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:2rem;">
                <div style="width:48px;height:48px;border-radius:50%;background:var(--color-primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1rem;font-weight:600;flex-shrink:0;">
                    <?= strtoupper(substr($course->instructor->name ?? 'I', 0, 1)) ?>
                </div>
                <div>
                    <div style="font-size:0.8rem; color:var(--color-text-muted);">Instruktur</div>
                    <div style="font-size:0.9rem; font-weight:600; color:var(--color-text);"><?= $course->instructor->name ?? 'Instruktur' ?></div>
                </div>
            </div>

            <!-- What you'll learn -->
            <div style="background:rgba(99,102,241,0.04); border:1px solid rgba(99,102,241,0.15); border-radius:var(--radius); padding:1.5rem; margin-bottom:2rem;">
                <h2 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">Yang Akan Anda Pelajari</h2>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.5rem;">
                    <?php $_items = $course->outcomes ?? ['Memahami konsep dasar', 'Membangun proyek nyata', 'Mendapatkan sertifikat', 'Bergabung komunitas pelajar']; if (!empty($_items) && (is_countable($_items) ? count($_items) > 0 : true)): foreach ($_items as $outcome): ?>
                    <div style="display:flex;align-items:flex-start;gap:0.5rem;font-size:0.875rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" style="flex-shrink:0;margin-top:1px;"><polyline points="20 6 9 17 4 12"/></svg>
                        <?= $outcome ?>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>

            <!-- Curriculum -->
            <h2 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">Kurikulum</h2>
            <div style="border:1px solid var(--color-border); border-radius:var(--radius); overflow:hidden;">
                <?php 
                $_items = $course->modules ?? []; 
                $modCount = is_countable($_items) ? count($_items) : 0;
                if (!empty($_items) && $modCount > 0): 
                    foreach ($_items as $i => $module): 
                ?>
                <div style="<?= $i < $modCount - 1 ? 'border-bottom:1px solid var(--color-border);' : '' ?>">
                    <button onclick="toggleModule(<?= $i ?>)" style="width:100%;padding:0.875rem 1.25rem;display:flex;align-items:center;justify-content:space-between;background:none;border:none;cursor:pointer;font-size:0.875rem;font-weight:600;color:var(--color-text);font-family:inherit;text-align:left;">
                        <span><?= $module->title ?></span>
                        <i data-lucide="chevron-down" id="module-icon-<?= $i ?>" style="width:16px;height:16px;transition:transform 0.2s;"></i>
                    </button>
                    <div id="module-content-<?= $i ?>" style="max-height:0;overflow:hidden;transition:max-height 0.3s ease;">
                        <?php foreach ($module->lessons ?? [] as $lesson): ?>
                        <div style="display:flex;align-items:center;gap:0.75rem;padding:0.625rem 1.25rem 0.625rem 2.5rem;border-top:1px solid var(--color-border);font-size:0.8rem;color:var(--color-text-muted);">
                            <i data-lucide="play-circle" style="width:14px;height:14px;flex-shrink:0;"></i>
                            <?= $lesson->title ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; else: ?>
                <div style="padding:1.5rem; text-align:center; color:var(--color-text-muted); font-size:0.875rem;">
                    Kurikulum akan segera tersedia.
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT: Sticky Purchase Card -->
        <div style="position:sticky; top:5rem;">
            <div style="border:1px solid var(--color-border); border-radius:var(--radius); overflow:hidden; background:var(--color-bg);">
                <!-- Course thumbnail -->
                <?php if (!empty($course->image)): ?>
                <div style="height:200px; width:100%; overflow:hidden; background:#0f172a;">
                    <img src="<?= $course->image ?>" alt="<?= htmlspecialchars($course->title ?? '') ?>" style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
                <?php else: ?>
                <div style="height:180px; background:linear-gradient(135deg,#4f46e5,#7c3aed); display:flex;align-items:center;justify-content:center;">
                    <i data-lucide="book-open" style="width:56px;height:56px;color:rgba(255,255,255,0.7);"></i>
                </div>
                <?php endif; ?>

                <div style="padding:1.5rem;">
                    <!-- Price & Discount -->
                    <div style="margin-bottom:1.25rem;">
                        <?php if (($course->price ?? 0) > 0): ?>
                            <div style="display:flex; align-items:baseline; gap:0.5rem; flex-wrap:wrap; margin-bottom:0.35rem;">
                                <span style="font-size:1.35rem; font-weight:800; color:var(--color-text); line-height:1.2;">
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
                                <span style="display:inline-block; font-size:0.75rem; font-weight:700; color:#ef4444; background:rgba(239,68,68,0.1); padding:0.2rem 0.55rem; border-radius:9999px;">
                                    Hemat <?= $discountPct ?>%
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <div style="display:flex; align-items:center; gap:0.5rem;">
                                <span style="font-size:1.25rem; font-weight:800; color:#10b981; line-height:1.2;">
                                    Gratis
                                </span>
                                <span style="font-size:0.75rem; font-weight:700; color:#10b981; background:rgba(16,185,129,0.1); padding:0.2rem 0.55rem; border-radius:9999px;">
                                    100% Akses Gratis
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Enroll button -->
                    <?php if (auth()->check()): ?>
                        <?php if ($isEnrolled ?? false): ?>
                        <a href="#" style="display:block;text-align:center;padding:0.875rem;background:#10b981;color:#fff;border-radius:8px;font-size:0.9rem;font-weight:700;text-decoration:none;margin-bottom:0.75rem;">
                            Lanjutkan Belajar →
                        </a>
                        <?php else: ?>
                        <form method="POST" action="<?= route('user.courses.enroll', $course) ?>">
                            <?= csrf_field() ?>
                            <button type="submit" id="enrollBtn" style="width:100%;padding:0.875rem;background:var(--color-primary);color:#fff;border:none;border-radius:8px;font-size:0.9rem;font-weight:700;cursor:pointer;margin-bottom:0.75rem;">
                                <?= ($course->price ?? 0) > 0 ? 'Beli Kursus Ini' : 'Daftar Gratis' ?>
                            </button>
                        </form>
                        <?php endif; ?>
                    <?php else: ?>
                    <a href="<?= route('login') ?>" id="loginToBuyBtn" style="display:block;text-align:center;padding:0.875rem;background:var(--color-primary);color:#fff;border-radius:8px;font-size:0.9rem;font-weight:700;text-decoration:none;margin-bottom:0.75rem;">
                        Masuk untuk Mendaftar
                    </a>
                    <?php endif; ?>

                    <!-- Guarantee -->
                    <p style="text-align:center;font-size:0.75rem;color:var(--color-text-muted);margin-bottom:1.25rem;">Garansi uang kembali 7 hari</p>

                    <!-- Includes -->
                    <div style="display:flex;flex-direction:column;gap:0.5rem;font-size:0.8rem;color:var(--color-text-muted);">
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <i data-lucide="infinity" style="width:14px;height:14px;"></i>
                            Akses seumur hidup
                        </div>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <i data-lucide="smartphone" style="width:14px;height:14px;"></i>
                            Akses dari semua perangkat
                        </div>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <i data-lucide="award" style="width:14px;height:14px;"></i>
                            Sertifikat kelulusan
                        </div>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <i data-lucide="download" style="width:14px;height:14px;"></i>
                            Materi dapat diunduh
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
</script>
<?php $extra_scripts = ($extra_scripts ?? '') . ob_get_clean(); ?>


<?php
// Render Layout
require __DIR__ . '/../../../layouts/app.php';
