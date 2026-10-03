<?php $title = 'Semua Kursus'; ?>
<?php $meta_description = 'Jelajahi beragam kursus online berkualitas tinggi di Edify. Kuasai teknologi, desain, bisnis, dan banyak lagi.'; ?>

<?php ob_start(); ?>

<style>
    /* ============================================================
       Responsive Course Catalog Styles
    ============================================================ */
    .courses-catalog-page {
        padding-top: 2rem;
        padding-bottom: 4.5rem;
    }

    /* Search & Filter Form */
    .courses-filter-card {
        background: var(--color-bg);
        border: 1px solid var(--color-border);
        border-radius: 1.25rem;
        padding: 1rem 1.25rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.03);
    }
    .courses-filter-form {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }
    .search-input-wrapper {
        position: relative;
        flex: 1 1 260px;
        height: 44px;
        box-sizing: border-box;
    }
    .search-input-wrapper i {
        position: absolute;
        left: 0.95rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--color-text-muted);
        pointer-events: none;
    }
    .search-input-field {
        width: 100%;
        height: 44px;
        padding: 0 1rem 0 2.5rem;
        border: 1px solid var(--color-border);
        border-radius: 0.75rem;
        font-size: 0.9rem;
        font-family: inherit;
        background: var(--color-bg-alt, rgba(0,0,0,0.02));
        color: var(--color-text);
        outline: none;
        box-sizing: border-box;
        -webkit-appearance: none;
        appearance: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .search-input-field:focus {
        border-color: var(--color-primary);
        background: var(--color-bg);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    .filter-select-group {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .filter-select {
        height: 44px;
        padding: 0 1.15rem;
        border: 1px solid var(--color-border);
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-family: inherit;
        background: var(--color-bg);
        color: var(--color-text);
        outline: none;
        cursor: pointer;
        box-sizing: border-box;
        -webkit-appearance: none;
        appearance: none;
        transition: border-color 0.2s ease;
    }
    .filter-select:focus {
        border-color: var(--color-primary);
    }
    .filter-submit-btn {
        height: 44px;
        padding: 0 1.4rem;
        background: var(--color-primary);
        color: #fff;
        border: none;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        box-sizing: border-box;
        transition: background 0.2s, transform 0.15s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
    .filter-submit-btn:hover {
        background: var(--color-primary-dark);
        transform: translateY(-1px);
    }

    /* Course Cards Grid */
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(100%, 310px), 1fr));
        gap: 1.75rem;
    }

    .course-card-item {
        background: var(--color-bg);
        border: 1px solid var(--color-border);
        border-radius: 1.15rem;
        overflow: hidden;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.25s cubic-bezier(0.16, 1, 0.3, 1),
                    border-color 0.25s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
    }
    .course-card-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 32px -6px rgba(0, 0, 0, 0.08);
        border-color: rgba(99, 102, 241, 0.4);
    }

    .course-card-thumb {
        height: 175px;
        width: 100%;
        position: relative;
        overflow: hidden;
        background: #0f172a;
    }
    .course-card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }
    .course-card-item:hover .course-card-thumb img {
        transform: scale(1.04);
    }

    .course-card-cat-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.25rem 0.65rem;
        border-radius: 9999px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .course-card-price-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.25rem 0.65rem;
        border-radius: 9999px;
        letter-spacing: 0.02em;
    }
    .badge-free {
        background: #10b981;
        color: #fff;
    }
    .badge-paid {
        background: rgba(99, 102, 241, 0.9);
        color: #fff;
    }

    .course-card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .course-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .course-card-desc {
        font-size: 0.85rem;
        color: var(--color-text-muted);
        line-height: 1.55;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }
    .course-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.85rem;
        border-top: 1px solid var(--color-border);
        font-size: 0.85rem;
    }
    .course-card-students {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        color: var(--color-text-muted);
        font-size: 0.825rem;
    }
    .course-card-price {
        font-size: 0.95rem;
        font-weight: 800;
    }
    .course-buy-btn {
        padding: 0.4rem 0.9rem;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 9999px;
        background: var(--color-primary);
        color: #ffffff;
        border: none;
        cursor: pointer;
        transition: background 0.15s ease, transform 0.15s ease;
    }
    .course-buy-btn:hover {
        background: var(--color-primary-dark);
        transform: translateY(-1px);
    }

    /* Empty state */
    .courses-empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4.5rem 1rem;
        background: var(--color-bg);
        border: 1px dashed var(--color-border);
        border-radius: 1.25rem;
    }

    /* Mobile screens adaptation */
    @media (max-width: 680px) {
        .courses-catalog-page {
            padding-top: 1.25rem;
            padding-bottom: 3.5rem;
        }
        .courses-filter-card {
            padding: 1rem;
            border-radius: 1rem;
        }
        .courses-filter-form {
            flex-direction: column;
            align-items: stretch;
            gap: 0.65rem;
        }
        .search-input-wrapper {
            flex: none;
            width: 100%;
            height: 44px;
        }
        .filter-select-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            width: 100%;
        }
        .filter-select {
            width: 100%;
            min-width: 0;
            height: 44px;
            padding: 0 0.85rem;
            font-size: 0.825rem;
        }
        .filter-submit-btn {
            width: 100%;
            height: 44px;
            justify-content: center;
        }
        .courses-grid {
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }
        .course-card-thumb {
            height: 160px;
        }
    }
</style>

<div class="container-md courses-catalog-page">

    <!-- Search & Filter Card (Responsive on all screen sizes) -->
    <div class="courses-filter-card">
        <form method="GET" action="<?= route('user.courses.index') ?>" class="courses-filter-form">
            <!-- Search bar -->
            <div class="search-input-wrapper">
                <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                <input type="text" name="search" id="courseSearchUser" value="<?= htmlspecialchars(request('search') ?? '') ?>" placeholder="Cari nama topik atau kursus..." class="search-input-field">
            </div>

            <!-- Filter selects -->
            <div class="filter-select-group">
                <select name="category" id="courseCategoryFilter" class="filter-select" aria-label="Filter Kategori">
                    <option value="">Semua Kategori</option>
                    <option value="teknologi" <?= request('category') === 'teknologi' ? 'selected' : '' ?>>Teknologi</option>
                    <option value="desain" <?= request('category') === 'desain' ? 'selected' : '' ?>>Desain</option>
                    <option value="bisnis" <?= request('category') === 'bisnis' ? 'selected' : '' ?>>Bisnis</option>
                    <option value="marketing" <?= request('category') === 'marketing' ? 'selected' : '' ?>>Marketing</option>
                </select>

                <select name="price" id="coursePriceFilter" class="filter-select" aria-label="Filter Harga">
                    <option value="">Semua Harga</option>
                    <option value="free" <?= request('price') === 'free' ? 'selected' : '' ?>>Gratis</option>
                    <option value="paid" <?= request('price') === 'paid' ? 'selected' : '' ?>>Berbayar</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="filter-submit-btn">
                <i data-lucide="filter" style="width: 15px; height: 15px;"></i>
                <span>Terapkan</span>
            </button>
        </form>
    </div>

    <!-- Courses Grid -->
    <div class="courses-grid">
        <?php 
        $_items = $courses ?? []; 
        $hasItems = !empty($_items) && (is_countable($_items) ? count($_items) > 0 : true);
        if ($hasItems): 
            foreach ($_items as $course): 
        ?>
        <div class="course-card-item">
            <!-- Card Thumbnail (Link to Detail) -->
            <a href="<?= route('user.courses.show', $course) ?>" class="course-card-thumb">
                <?php if (!empty($course->image)): ?>
                    <img src="<?= htmlspecialchars($course->image) ?>" alt="<?= htmlspecialchars($course->title ?? '') ?>" loading="lazy">
                <?php else: ?>
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;">
                        <i data-lucide="book-open" style="width:52px;height:52px;color:rgba(255,255,255,0.7);"></i>
                    </div>
                <?php endif; ?>

                <span class="course-card-cat-badge"><?= htmlspecialchars($course->category ?? 'Teknologi') ?></span>

                <?php if (($course->price ?? 0) == 0): ?>
                    <span class="course-card-price-badge badge-free">GRATIS</span>
                <?php else: ?>
                    <span class="course-card-price-badge badge-paid">PREMIUM</span>
                <?php endif; ?>
            </a>

            <!-- Card Body -->
            <div class="course-card-body">
                <h2 class="course-card-title">
                    <a href="<?= route('user.courses.show', $course) ?>" style="color:inherit; text-decoration:none;">
                        <?= htmlspecialchars($course->title ?? 'Kursus Edify') ?>
                    </a>
                </h2>
                <p class="course-card-desc"><?= htmlspecialchars($course->description ?? 'Tingkatkan keahlian praktis bersama instruktur ahli.') ?></p>

                <div class="course-card-footer">
                    <div class="course-card-students">
                        <i data-lucide="users" style="width: 14px; height: 14px;"></i>
                        <span><?= $course->enrollments_count ?? 0 ?> pelajar</span>
                    </div>

                    <div style="display:flex; align-items:center; gap:0.6rem;">
                        <span class="course-card-price" style="color: <?= ($course->price ?? 0) > 0 ? 'var(--color-primary)' : '#10b981' ?>;">
                            <?= ($course->price ?? 0) > 0 ? 'Rp ' . number_format($course->price, 0, ',', '.') : 'Gratis' ?>
                        </span>
                        <button type="button" class="course-buy-btn" onclick="orderCourse(event, '<?= htmlspecialchars(addslashes($course->title ?? 'Kursus')) ?>')">
                            <?= ($course->price ?? 0) > 0 ? 'Pesan' : 'Daftar' ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; else: ?>
        <div class="courses-empty-state">
            <div style="width:56px;height:56px;border-radius:50%;background:rgba(99,102,241,0.08);color:var(--color-primary);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                <i data-lucide="search-x" style="width:28px;height:28px;"></i>
            </div>
            <h3 style="font-size:1.15rem;font-weight:700;margin-bottom:0.35rem;color:var(--color-text);">Tidak ada kursus ditemukan</h3>
            <p style="color:var(--color-text-muted);font-size:0.9rem;margin-bottom:1.25rem;">Coba sesuaikan kata kunci pencarian atau ubah filter kategori dan harga.</p>
            <a href="<?= route('user.courses.index') ?>" class="filter-submit-btn" style="text-decoration:none;display:inline-flex;">
                <i data-lucide="refresh-cw" style="width:14px;height:14px;"></i>
                <span>Reset Pencarian</span>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (isset($courses) && $courses->hasPages()): ?>
    <div style="margin-top:2.5rem; display:flex; justify-content:center;">
        <?= $courses->withQueryString()->links() ?>
    </div>
    <?php endif; ?>
</div>

<script>
    function orderCourse(e, courseTitle) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
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

<?php $content = ob_get_clean(); ?>

<?php
// Render Layout
require __DIR__ . '/../../../layouts/app.php';
