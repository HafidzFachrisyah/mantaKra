<?php

namespace App\Models;

/**
 * JabatanModel - JSON-based model for managing position data
 * 
 * Handles reading/writing position data from/to a JSON file,
 * automatic status classification, and NIP-based retirement calculation.
 */
class JabatanModel
{
    /** @var string Path to the JSON data file */
    protected string $dataFile;

    public function __construct()
    {
        $this->dataFile = WRITEPATH . 'data/jabatan.json';
        
        // Ensure the data directory exists
        $dir = dirname($this->dataFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    /**
     * Get all position data from JSON storage
     *
     * @return array
     */
    public function getData(): array
    {
        if (!file_exists($this->dataFile)) {
            return [];
        }

        $content = file_get_contents($this->dataFile);
        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }

    /**
     * Save data to JSON file
     *
     * @param array $data
     * @return bool
     */
    public function saveData(array $data): bool
    {
        $jsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return file_put_contents($this->dataFile, $jsonContent) !== false;
    }

    /**
     * Import data from parsed Excel rows, merge with existing data (deduplicate by jabatan name)
     *
     * @param array $rows Array of associative arrays with keys matching Excel columns
     * @return array ['total' => int, 'new' => int, 'updated' => int, 'skipped' => int]
     */
    public function importData(array $rows): array
    {
        $existingData = $this->getData();
        $stats = ['total' => count($rows), 'new' => 0, 'updated' => 0, 'skipped' => 0];

        // Index existing data by jabatan name for fast lookup
        $indexed = [];
        foreach ($existingData as $item) {
            $indexed[$item['jabatan']] = $item;
        }

        foreach ($rows as $row) {
            $jabatanName = trim($row['jabatan'] ?? '');
            if (empty($jabatanName)) {
                $stats['skipped']++;
                continue;
            }

            // Clean NIP (remove leading apostrophe and whitespace)
            $nip = $this->cleanNip($row['nip'] ?? '');
            $namaPegawai = trim($row['nama_pegawai'] ?? '');

            // Calculate status
            $status = $this->calculateStatus($nip, $namaPegawai);

            $record = [
                'jabatan'       => $jabatanName,
                'status'        => $status,
                'nip'           => $nip,
                'nama_pegawai'  => $namaPegawai,
                'eselon'        => trim($row['eselon'] ?? ''),
                'unit_kerja_3'  => trim($row['unit_kerja_3'] ?? ''),
                'unit_kerja_2'  => trim($row['unit_kerja_2'] ?? ''),
                'unit_kerja_1'  => trim($row['unit_kerja_1'] ?? ''),
                'tahun_pensiun' => $nip ? $this->getRetirementYear($nip) : null,
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            if (isset($indexed[$jabatanName])) {
                // Update existing record
                $indexed[$jabatanName] = $record;
                $stats['updated']++;
            } else {
                // Add new record
                $indexed[$jabatanName] = $record;
                $stats['new']++;
            }
        }

        // Save back
        $this->saveData(array_values($indexed));

        return $stats;
    }

    /**
     * Calculate position status based on NIP and employee name
     *
     * @param string $nip
     * @param string $namaPegawai
     * @return string 'isi', 'kosong', or 'akan_kosong'
     */
    public function calculateStatus(string $nip, string $namaPegawai): string
    {
        // If no NIP and no name, position is empty
        if (empty($nip) && empty($namaPegawai)) {
            return 'kosong';
        }

        // If NIP exists, check retirement
        if (!empty($nip)) {
            $retirementYear = $this->getRetirementYear($nip);
            $currentYear = (int) date('Y');

            if ($retirementYear !== null && $retirementYear <= $currentYear) {
                return 'akan_kosong';
            }
        }

        return 'isi';
    }

    /**
     * Extract birth date from NIP (first 8 digits = YYYYMMDD)
     *
     * @param string $nip
     * @return array|null ['year' => int, 'month' => int, 'day' => int]
     */
    public function parseNipBirthDate(string $nip): ?array
    {
        $nip = $this->cleanNip($nip);

        if (strlen($nip) < 8) {
            return null;
        }

        $year  = (int) substr($nip, 0, 4);
        $month = (int) substr($nip, 4, 2);
        $day   = (int) substr($nip, 6, 2);

        // Basic validation
        if ($year < 1940 || $year > 2010 || $month < 1 || $month > 12 || $day < 1 || $day > 31) {
            return null;
        }

        return [
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
        ];
    }

    /**
     * Calculate retirement year from NIP (birth year + 58)
     *
     * @param string $nip
     * @return int|null
     */
    public function getRetirementYear(string $nip): ?int
    {
        $birthDate = $this->parseNipBirthDate($nip);

        if ($birthDate === null) {
            return null;
        }

        return $birthDate['year'] + 58;
    }

    /**
     * Clean NIP value (remove leading apostrophe, whitespace, non-numeric chars)
     *
     * @param string $nip
     * @return string
     */
    public function cleanNip(string $nip): string
    {
        $nip = trim($nip);
        $nip = ltrim($nip, "'");
        $nip = preg_replace('/[^0-9]/', '', $nip);
        return $nip;
    }

    /**
     * Get data filtered by status
     *
     * @param string $status 'isi', 'kosong', 'akan_kosong', or 'semua'
     * @return array
     */
    public function getByStatus(string $status = 'semua'): array
    {
        $data = $this->getData();

        if ($status === 'semua') {
            return $data;
        }

        return array_values(array_filter($data, function ($item) use ($status) {
            return ($item['status'] ?? '') === $status;
        }));
    }

    /**
     * Get statistics count per status
     *
     * @return array ['total' => int, 'isi' => int, 'kosong' => int, 'akan_kosong' => int]
     */
    public function getStats(): array
    {
        $data = $this->getData();
        $stats = [
            'total'       => count($data),
            'isi'         => 0,
            'kosong'      => 0,
            'akan_kosong' => 0,
        ];

        foreach ($data as $item) {
            $s = $item['status'] ?? 'kosong';
            if (isset($stats[$s])) {
                $stats[$s]++;
            }
        }

        return $stats;
    }

    /**
     * Delete all data
     *
     * @return bool
     */
    public function deleteAll(): bool
    {
        return $this->saveData([]);
    }

    /**
     * Check if JSON data file exists and has data
     *
     * @return bool
     */
    public function hasData(): bool
    {
        return !empty($this->getData());
    }
}
