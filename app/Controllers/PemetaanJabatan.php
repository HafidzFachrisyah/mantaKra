<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use App\Libraries\ExcelHelper;

/**
 * PemetaanJabatan Controller
 * 
 * Handles the Position Mapping module:
 * - Dashboard with statistics
 * - Excel import
 * - Excel export per classification
 * - Data reset
 */
class PemetaanJabatan extends BaseController
{
    protected JabatanModel $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }

    /**
     * Dashboard - Main page showing statistics and data table
     */
    public function index(): string
    {
        $filter = $this->request->getGet('filter') ?? 'semua';
        $search = $this->request->getGet('search') ?? '';
        $page   = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 15;

        // Get data based on filter
        $allData = $this->jabatanModel->getByStatus($filter);

        // Apply search filter
        if (!empty($search)) {
            $searchLower = mb_strtolower($search);
            $allData = array_values(array_filter($allData, function ($item) use ($searchLower) {
                return mb_strpos(mb_strtolower($item['jabatan'] ?? ''), $searchLower) !== false
                    || mb_strpos(mb_strtolower($item['nama_pegawai'] ?? ''), $searchLower) !== false
                    || mb_strpos(mb_strtolower($item['nip'] ?? ''), $searchLower) !== false
                    || mb_strpos(mb_strtolower($item['unit_kerja_1'] ?? ''), $searchLower) !== false
                    || mb_strpos(mb_strtolower($item['unit_kerja_2'] ?? ''), $searchLower) !== false
                    || mb_strpos(mb_strtolower($item['unit_kerja_3'] ?? ''), $searchLower) !== false;
            }));
        }

        // Pagination
        $totalItems = count($allData);
        $totalPages = max(1, (int) ceil($totalItems / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $paginatedData = array_slice($allData, $offset, $perPage);

        $data = [
            'title'       => 'Pemetaan Jabatan',
            'stats'       => $this->jabatanModel->getStats(),
            'jabatan'     => $paginatedData,
            'filter'      => $filter,
            'search'      => $search,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
            'totalItems'  => $totalItems,
            'perPage'     => $perPage,
            'offset'      => $offset,
            'flashSuccess' => session()->getFlashdata('success'),
            'flashError'   => session()->getFlashdata('error'),
        ];

        return view('pemetaan/dashboard', $data);
    }

    /**
     * Handle Excel file import
     */
    public function import()
    {
        // Validate uploaded file
        $file = $this->request->getFile('excel_file');

        if (!$file || !$file->isValid()) {
            session()->setFlashdata('error', 'File tidak valid. Silakan coba lagi.');
            return redirect()->to('/pemetaan');
        }

        // Check file extension
        $ext = strtolower($file->getExtension());
        if (!in_array($ext, ['xlsx', 'xls'])) {
            session()->setFlashdata('error', 'Format file harus .xlsx atau .xls');
            return redirect()->to('/pemetaan');
        }

        // Check file size (max 10MB)
        if ($file->getSizeByUnit('mb') > 10) {
            session()->setFlashdata('error', 'Ukuran file maksimal 10MB.');
            return redirect()->to('/pemetaan');
        }

        try {
            // Move to temp location
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $filePath = WRITEPATH . 'uploads/' . $newName;

            // Parse Excel
            $excelHelper = new ExcelHelper();
            $rows = $excelHelper->readExcel($filePath);

            if (empty($rows)) {
                session()->setFlashdata('error', 'File Excel kosong atau format tidak sesuai template.');
                @unlink($filePath);
                return redirect()->to('/pemetaan');
            }

            // Import data (with deduplication)
            $stats = $this->jabatanModel->importData($rows);

            // Cleanup uploaded file
            @unlink($filePath);

            $message = "Import berhasil! Total: {$stats['total']} baris. "
                     . "Baru: {$stats['new']}, Diperbarui: {$stats['updated']}, Dilewati: {$stats['skipped']}.";

            session()->setFlashdata('success', $message);

        } catch (\Exception $e) {
            log_message('error', 'Import Excel error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat mengimpor: ' . $e->getMessage());
        }

        return redirect()->to('/pemetaan');
    }

    /**
     * Export data to Excel by status
     *
     * @param string $status 'isi', 'kosong', 'akan_kosong', or 'semua'
     */
    public function export(string $status = 'semua')
    {
        $data = $this->jabatanModel->getByStatus($status);

        if (empty($data)) {
            session()->setFlashdata('error', 'Tidak ada data untuk diekspor.');
            return redirect()->to('/pemetaan');
        }

        $labels = [
            'semua'       => 'Semua Jabatan',
            'isi'         => 'Jabatan Terisi',
            'kosong'      => 'Jabatan Kosong',
            'akan_kosong' => 'Jabatan Akan Kosong',
        ];

        $label = $labels[$status] ?? 'Data Jabatan';
        $filename = 'Pemetaan_' . str_replace(' ', '_', $label) . '_' . date('Y-m-d');

        $excelHelper = new ExcelHelper();
        $excelHelper->exportExcel($data, $filename, $label);
    }

    /**
     * Delete all data
     */
    public function deleteAll()
    {
        $this->jabatanModel->deleteAll();
        session()->setFlashdata('success', 'Semua data berhasil dihapus.');
        return redirect()->to('/pemetaan');
    }
}
