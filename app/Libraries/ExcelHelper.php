<?php

namespace App\Libraries;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

/**
 * ExcelHelper - Library for reading and writing Excel files
 * 
 * Uses PhpSpreadsheet to parse uploaded Excel files and
 * generate downloadable Excel exports.
 */
class ExcelHelper
{
    /**
     * Column mapping: column letter => internal key
     */
    protected array $columnMap = [
        'A' => 'jabatan',
        'B' => 'isi_kosong',
        'C' => 'nip',
        'D' => 'nama_pegawai',
        'E' => 'eselon',
        'F' => 'unit_kerja_3',
        'G' => 'unit_kerja_2',
        'H' => 'unit_kerja_1',
    ];

    /**
     * Read Excel file and return array of rows
     *
     * @param string $filePath Absolute path to the Excel file
     * @return array Array of associative arrays
     * @throws \Exception
     */
    public function readExcel(string $filePath): array
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];

        $highestRow = $worksheet->getHighestRow();

        // Start from row 2 (skip header)
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = [];
            $hasData = false;

            foreach ($this->columnMap as $colLetter => $key) {
                $coordinate = $colLetter . $row;
                $cellValue = $worksheet->getCell($coordinate)->getValue();
                
                // Clean the value
                if ($cellValue !== null) {
                    $cellValue = trim((string) $cellValue);
                    // Remove leading apostrophe from NIP
                    if ($key === 'nip') {
                        $cellValue = ltrim($cellValue, "'");
                    }
                }
                
                $rowData[$key] = $cellValue ?? '';
                
                if (!empty($cellValue)) {
                    $hasData = true;
                }
            }

            // Only add rows that have at least some data
            if ($hasData && !empty($rowData['jabatan'])) {
                $rows[] = $rowData;
            }
        }

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

        return $rows;
    }

    /**
     * Export data to Excel file and trigger download
     *
     * @param array  $data     Array of position data
     * @param string $filename Filename for download (without extension)
     * @param string $title    Sheet title
     * @return void
     */
    public function exportExcel(array $data, string $filename, string $title = 'Data Jabatan'): void
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(mb_substr($title, 0, 31)); // Sheet name max 31 chars

        // Headers
        $headers = ['A' => 'No', 'B' => 'Jabatan', 'C' => 'Status', 'D' => 'NIP', 'E' => 'Nama Pegawai', 'F' => 'Eselon', 'G' => 'Unit Kerja 3', 'H' => 'Unit Kerja 2', 'I' => 'Unit Kerja 1', 'J' => 'Tahun Pensiun'];

        // Style for header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E40AF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        // Write headers
        foreach ($headers as $col => $header) {
            $sheet->getCell($col . '1')->setValue($header);
        }
        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Write data
        $row = 2;
        foreach ($data as $index => $item) {
            $statusLabel = match($item['status'] ?? '') {
                'isi' => 'Isi',
                'kosong' => 'Kosong',
                'akan_kosong' => 'Akan Kosong',
                default => '-',
            };

            $sheet->getCell("A{$row}")->setValue($index + 1);
            $sheet->getCell("B{$row}")->setValue($item['jabatan'] ?? '');
            $sheet->getCell("C{$row}")->setValue($statusLabel);
            $sheet->getCell("D{$row}")->setValue($item['nip'] ?? '');
            $sheet->getCell("E{$row}")->setValue($item['nama_pegawai'] ?? '');
            $sheet->getCell("F{$row}")->setValue($item['eselon'] ?? '');
            $sheet->getCell("G{$row}")->setValue($item['unit_kerja_3'] ?? '');
            $sheet->getCell("H{$row}")->setValue($item['unit_kerja_2'] ?? '');
            $sheet->getCell("I{$row}")->setValue($item['unit_kerja_1'] ?? '');
            $sheet->getCell("J{$row}")->setValue($item['tahun_pensiun'] ?? '-');

            // Status color coding
            $statusColor = match($item['status'] ?? '') {
                'isi' => 'DCFCE7',         // green light
                'kosong' => 'FEE2E2',      // red light
                'akan_kosong' => 'FEF3C7', // yellow light
                default => 'FFFFFF',
            };
            $sheet->getStyle("C{$row}")->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setRGB($statusColor);

            // Borders for data rows
            $sheet->getStyle("A{$row}:J{$row}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'D1D5DB'],
                    ],
                ],
            ]);

            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set NIP column as text to preserve leading zeros
        $sheet->getStyle('D2:D' . ($row - 1))->getNumberFormat()
            ->setFormatCode('@');

        // Output
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        exit;
    }
}
