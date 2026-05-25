<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<!-- Flash Messages -->
<?php if (!empty($flashSuccess)): ?>
<div id="flash-success" class="mb-6 animate-slide-down">
    <div class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-emerald-50 border border-emerald-200/60 shadow-sm">
        <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>
        <p class="text-sm font-medium text-emerald-800 flex-1"><?= esc($flashSuccess) ?></p>
        <button onclick="document.getElementById('flash-success').remove()" class="text-emerald-400 hover:text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($flashError)): ?>
<div id="flash-error" class="mb-6 animate-slide-down">
    <div class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-red-50 border border-red-200/60 shadow-sm">
        <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
        </div>
        <p class="text-sm font-medium text-red-800 flex-1"><?= esc($flashError) ?></p>
        <button onclick="document.getElementById('flash-error').remove()" class="text-red-400 hover:text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
    </div>
</div>
<?php endif; ?>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <!-- Total -->
    <div class="glass-card rounded-2xl p-5 border border-white/40 shadow-lg shadow-slate-200/50 hover-lift animate-slide-up" style="animation-delay: 0ms">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-slate-500 to-slate-700 flex items-center justify-center shadow-lg shadow-slate-400/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                </svg>
            </div>
            <a href="<?= base_url('pemetaan?filter=semua') ?>" class="text-xs text-slate-400 hover:text-primary-600 font-medium flex items-center gap-1">
                Lihat
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </a>
        </div>
        <p class="text-3xl font-extrabold text-slate-800"><?= number_format($stats['total']) ?></p>
        <p class="text-xs font-medium text-slate-400 mt-1">Total Jabatan</p>
    </div>

    <!-- Isi -->
    <div class="glass-card rounded-2xl p-5 border border-emerald-100/60 shadow-lg shadow-emerald-100/50 hover-lift animate-slide-up" style="animation-delay: 80ms">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center shadow-lg shadow-emerald-400/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <a href="<?= base_url('pemetaan?filter=isi') ?>" class="text-xs text-slate-400 hover:text-emerald-600 font-medium flex items-center gap-1">
                Lihat
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </a>
        </div>
        <p class="text-3xl font-extrabold text-emerald-700"><?= number_format($stats['isi']) ?></p>
        <p class="text-xs font-medium text-emerald-500/70 mt-1">Jabatan Terisi</p>
    </div>

    <!-- Kosong -->
    <div class="glass-card rounded-2xl p-5 border border-red-100/60 shadow-lg shadow-red-100/50 hover-lift animate-slide-up" style="animation-delay: 160ms">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg shadow-red-400/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <a href="<?= base_url('pemetaan?filter=kosong') ?>" class="text-xs text-slate-400 hover:text-red-600 font-medium flex items-center gap-1">
                Lihat
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </a>
        </div>
        <p class="text-3xl font-extrabold text-red-700"><?= number_format($stats['kosong']) ?></p>
        <p class="text-xs font-medium text-red-500/70 mt-1">Jabatan Kosong</p>
    </div>

    <!-- Akan Kosong -->
    <div class="glass-card rounded-2xl p-5 border border-amber-100/60 shadow-lg shadow-amber-100/50 hover-lift animate-slide-up" style="animation-delay: 240ms">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-400/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <a href="<?= base_url('pemetaan?filter=akan_kosong') ?>" class="text-xs text-slate-400 hover:text-amber-600 font-medium flex items-center gap-1">
                Lihat
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </a>
        </div>
        <p class="text-3xl font-extrabold text-amber-700"><?= number_format($stats['akan_kosong']) ?></p>
        <p class="text-xs font-medium text-amber-500/70 mt-1">Akan Kosong (Pensiun <?= date('Y') ?>)</p>
    </div>
</div>

<!-- Action Bar -->
<div class="glass-card rounded-2xl border border-white/40 shadow-lg shadow-slate-200/50 p-5 mb-6 animate-slide-up" style="animation-delay: 300ms">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
        <!-- Left: Import & Delete -->
        <div class="flex items-center gap-3">
            <button onclick="openImportModal()" id="btn-import"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm font-semibold shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:from-primary-700 hover:to-primary-800 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
                Import Excel
            </button>

            <?php if ($stats['total'] > 0): ?>
            <form action="<?= base_url('pemetaan/delete') ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus semua data? Tindakan ini tidak dapat dibatalkan.')">
                <?= csrf_field() ?>
                <button type="submit" id="btn-delete-all"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-red-600 text-sm font-medium border border-red-200 hover:bg-red-50 hover:border-red-300 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Reset Data
                </button>
            </form>
            <?php endif; ?>
        </div>

        <!-- Right: Export Buttons -->
        <?php if ($stats['total'] > 0): ?>
        <div class="flex items-center gap-2 flex-wrap">
            <span class="text-xs text-slate-400 font-medium mr-1">Export:</span>
            <a href="<?= base_url('pemetaan/export/semua') ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-medium hover:bg-slate-200 border border-slate-200/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                Semua
            </a>
            <a href="<?= base_url('pemetaan/export/isi') ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-medium hover:bg-emerald-100 border border-emerald-200/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                Terisi
            </a>
            <a href="<?= base_url('pemetaan/export/kosong') ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-medium hover:bg-red-100 border border-red-200/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                Kosong
            </a>
            <a href="<?= base_url('pemetaan/export/akan_kosong') ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-xs font-medium hover:bg-amber-100 border border-amber-200/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                Akan Kosong
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Filter Tabs + Search -->
<div class="glass-card rounded-2xl border border-white/40 shadow-lg shadow-slate-200/50 mb-6 animate-slide-up" style="animation-delay: 360ms">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-5">
        <!-- Filter Tabs -->
        <div class="flex items-center gap-1 bg-slate-100/80 p-1 rounded-xl">
            <?php
            $filters = [
                'semua' => ['label' => 'Semua', 'count' => $stats['total']],
                'isi' => ['label' => 'Terisi', 'count' => $stats['isi']],
                'kosong' => ['label' => 'Kosong', 'count' => $stats['kosong']],
                'akan_kosong' => ['label' => 'Akan Kosong', 'count' => $stats['akan_kosong']],
            ];
            foreach ($filters as $key => $f):
                $isActive = ($filter === $key);
            ?>
            <a href="<?= base_url('pemetaan?filter=' . $key . (!empty($search) ? '&search=' . urlencode($search) : '')) ?>"
               class="px-3 py-2 rounded-lg text-xs font-semibold <?= $isActive ? 'bg-white text-primary-700 shadow-sm border border-primary-100/50' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50' ?>">
                <?= $f['label'] ?>
                <span class="ml-1 text-[10px] <?= $isActive ? 'text-primary-400' : 'text-slate-400' ?>"><?= $f['count'] ?></span>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Search -->
        <form action="<?= base_url('pemetaan') ?>" method="get" class="flex items-center gap-2">
            <input type="hidden" name="filter" value="<?= esc($filter) ?>">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="text" name="search" value="<?= esc($search) ?>" placeholder="Cari jabatan, nama, NIP..." id="search-input"
                    class="pl-9 pr-4 py-2 rounded-xl border border-slate-200 bg-white/80 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-400 w-64">
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-primary-50 text-primary-600 text-sm font-medium hover:bg-primary-100 border border-primary-200/60">
                Cari
            </button>
            <?php if (!empty($search)): ?>
            <a href="<?= base_url('pemetaan?filter=' . $filter) ?>" class="px-3 py-2 rounded-xl text-xs text-slate-500 hover:text-red-500 hover:bg-red-50 border border-slate-200">
                Reset
            </a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="glass-card rounded-2xl border border-white/40 shadow-lg shadow-slate-200/50 overflow-hidden animate-slide-up" style="animation-delay: 420ms">
    <?php if (empty($jabatan)): ?>
    <!-- Empty State -->
    <div class="flex flex-col items-center justify-center py-20 px-8">
        <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-700 mb-2">
            <?= !empty($search) ? 'Tidak ditemukan' : 'Belum ada data' ?>
        </h3>
        <p class="text-sm text-slate-400 text-center max-w-md mb-6">
            <?= !empty($search) 
                ? 'Tidak ada jabatan yang cocok dengan pencarian "' . esc($search) . '". Coba kata kunci lain.' 
                : 'Import file Excel untuk memulai pemetaan jabatan. Gunakan template yang sesuai format.' ?>
        </p>
        <?php if (empty($search)): ?>
        <button onclick="openImportModal()"
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm font-semibold shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
            </svg>
            Import File Excel
        </button>
        <?php endif; ?>
    </div>
    <?php else: ?>
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full" id="data-table">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-slate-100/80 border-b border-slate-200/60">
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">No</th>
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">Jabatan</th>
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">Status</th>
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">NIP</th>
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">Nama Pegawai</th>
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">Eselon</th>
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">Unit Kerja</th>
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">Pensiun</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php foreach ($jabatan as $i => $item): ?>
                <tr class="table-row-hover">
                    <td class="px-5 py-3 text-sm text-slate-500 font-medium"><?= $offset + $i + 1 ?></td>
                    <td class="px-5 py-3">
                        <p class="text-sm font-semibold text-slate-700 leading-snug max-w-xs"><?= esc($item['jabatan']) ?></p>
                    </td>
                    <td class="px-5 py-3">
                        <?php
                        $statusConfig = match($item['status'] ?? '') {
                            'isi' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500', 'label' => 'Terisi'],
                            'kosong' => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'border' => 'border-red-200', 'dot' => 'bg-red-500', 'label' => 'Kosong'],
                            'akan_kosong' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'dot' => 'bg-amber-500', 'label' => 'Akan Kosong'],
                            default => ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'dot' => 'bg-slate-400', 'label' => '-'],
                        };
                        ?>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold <?= $statusConfig['bg'] ?> <?= $statusConfig['text'] ?> border <?= $statusConfig['border'] ?>">
                            <span class="w-1.5 h-1.5 rounded-full <?= $statusConfig['dot'] ?>"></span>
                            <?= $statusConfig['label'] ?>
                        </span>
                    </td>
                    <td class="px-5 py-3 text-sm text-slate-600 font-mono text-xs"><?= esc($item['nip'] ?? '-') ?: '-' ?></td>
                    <td class="px-5 py-3 text-sm text-slate-600"><?= esc($item['nama_pegawai'] ?? '-') ?: '-' ?></td>
                    <td class="px-5 py-3">
                        <?php if (!empty($item['eselon'])): ?>
                        <span class="inline-flex px-2 py-0.5 rounded-md bg-primary-50 text-primary-700 text-xs font-semibold border border-primary-100"><?= esc($item['eselon']) ?></span>
                        <?php else: ?>
                        <span class="text-xs text-slate-400">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-3">
                        <p class="text-xs text-slate-600 font-medium"><?= esc($item['unit_kerja_1'] ?? '-') ?></p>
                        <?php if (!empty($item['unit_kerja_2']) && $item['unit_kerja_2'] !== $item['unit_kerja_1']): ?>
                        <p class="text-[10px] text-slate-400 mt-0.5"><?= esc($item['unit_kerja_2']) ?></p>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-3">
                        <?php if (!empty($item['tahun_pensiun'])): ?>
                        <span class="text-xs font-semibold <?= $item['tahun_pensiun'] <= date('Y') ? 'text-amber-600' : 'text-slate-500' ?>">
                            <?= $item['tahun_pensiun'] ?>
                        </span>
                        <?php else: ?>
                        <span class="text-xs text-slate-400">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
    <div class="flex items-center justify-between px-5 py-4 border-t border-slate-100">
        <p class="text-xs text-slate-500">
            Menampilkan <span class="font-semibold text-slate-700"><?= $offset + 1 ?>-<?= min($offset + $perPage, $totalItems) ?></span> dari <span class="font-semibold text-slate-700"><?= $totalItems ?></span> data
        </p>
        <div class="flex items-center gap-1">
            <?php if ($currentPage > 1): ?>
            <a href="<?= base_url('pemetaan?filter=' . $filter . '&page=' . ($currentPage - 1) . (!empty($search) ? '&search=' . urlencode($search) : '')) ?>"
               class="px-3 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-100 border border-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
            </a>
            <?php endif; ?>

            <?php
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);
            for ($p = $startPage; $p <= $endPage; $p++):
            ?>
            <a href="<?= base_url('pemetaan?filter=' . $filter . '&page=' . $p . (!empty($search) ? '&search=' . urlencode($search) : '')) ?>"
               class="px-3 py-1.5 rounded-lg text-xs font-medium <?= $p === $currentPage ? 'bg-primary-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
                <?= $p ?>
            </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
            <a href="<?= base_url('pemetaan?filter=' . $filter . '&page=' . ($currentPage + 1) . (!empty($search) ? '&search=' . urlencode($search) : '')) ?>"
               class="px-3 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-100 border border-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Import Modal -->
<div id="import-modal" class="fixed inset-0 z-50 hidden">
    <div class="modal-backdrop absolute inset-0" onclick="closeImportModal()"></div>
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="relative glass-card rounded-2xl border border-white/40 shadow-2xl w-full max-w-lg animate-scale-in p-0 overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Import Data Excel</h3>
                            <p class="text-xs text-primary-200">Upload file sesuai template</p>
                        </div>
                    </div>
                    <button onclick="closeImportModal()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form action="<?= base_url('pemetaan/import') ?>" method="post" enctype="multipart/form-data" id="import-form">
                <?= csrf_field() ?>
                <div class="p-6">
                    <!-- Info -->
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-blue-50 border border-blue-100 mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-blue-800">Informasi Import</p>
                            <ul class="text-xs text-blue-600 mt-1 space-y-0.5">
                                <li>• Format file: .xlsx atau .xls (maks 10MB)</li>
                                <li>• Data duplikat akan diperbarui otomatis</li>
                                <li>• Status jabatan dihitung otomatis dari NIP</li>
                                <li>• Usia pensiun: 58 tahun</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Upload Area -->
                    <div class="relative" id="upload-area">
                        <input type="file" name="excel_file" id="excel-file" accept=".xlsx,.xls" required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                            onchange="handleFileSelect(this)">
                        <div class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center hover:border-primary-400 hover:bg-primary-50/30" id="drop-zone">
                            <div class="w-14 h-14 mx-auto rounded-xl bg-slate-100 flex items-center justify-center mb-3" id="upload-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-600" id="file-name-display">Klik atau drag file Excel ke sini</p>
                            <p class="text-xs text-slate-400 mt-1" id="file-size-display">Mendukung format .xlsx dan .xls</p>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeImportModal()"
                        class="px-5 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 border border-slate-200">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit-import"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm font-semibold shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                        <span id="btn-submit-text">Import Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Modal functions
    function openImportModal() {
        document.getElementById('import-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImportModal() {
        document.getElementById('import-modal').classList.add('hidden');
        document.body.style.overflow = '';
        // Reset file input
        document.getElementById('excel-file').value = '';
        document.getElementById('file-name-display').textContent = 'Klik atau drag file Excel ke sini';
        document.getElementById('file-size-display').textContent = 'Mendukung format .xlsx dan .xls';
        document.getElementById('btn-submit-import').disabled = true;
        document.getElementById('upload-icon').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>';
    }

    // File selection handler
    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const ext = file.name.split('.').pop().toLowerCase();

            if (!['xlsx', 'xls'].includes(ext)) {
                alert('Format file harus .xlsx atau .xls');
                input.value = '';
                return;
            }

            const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
            document.getElementById('file-name-display').textContent = file.name;
            document.getElementById('file-size-display').textContent = sizeMB + ' MB';
            document.getElementById('btn-submit-import').disabled = false;

            // Change icon to success
            document.getElementById('upload-icon').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>';
            document.getElementById('drop-zone').classList.add('border-emerald-300', 'bg-emerald-50/30');
            document.getElementById('drop-zone').classList.remove('border-slate-300');
        }
    }

    // Form submission loading state
    document.getElementById('import-form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-submit-import');
        btn.disabled = true;
        document.getElementById('btn-submit-text').textContent = 'Mengimport...';
        btn.insertAdjacentHTML('afterbegin', '<svg class="animate-spin w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>');
    });

    // Auto-dismiss flash messages after 8 seconds
    setTimeout(function() {
        const flash = document.getElementById('flash-success');
        if (flash) {
            flash.style.transition = 'opacity 0.5s, transform 0.5s';
            flash.style.opacity = '0';
            flash.style.transform = 'translateY(-10px)';
            setTimeout(() => flash.remove(), 500);
        }
    }, 8000);

    // ESC key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImportModal();
    });
</script>
<?= $this->endSection() ?>
