<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\SOSReport;
use Carbon\Carbon;

class CompletedSOSReportsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    private $rowNumber = 0;
    private $startDate;
    private $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }

    public function collection()
    {
        $collection = SOSReport::with('user')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('date_time', 'desc')
            ->get()
            ->map(function ($report) {
                return [
                    'Reported By' => $report->user ? $report->user->fname . ' ' . $report->user->lname : 'Unknown',
                    'Location'    => $report->location,
                    'Description' => $report->description,
                    'Date & Time' => Carbon::parse($report->date_time)->format('F j, Y g:i A'),
                    'Submitted At' => Carbon::parse($report->created_at)->format('F j, Y g:i A'),
                    'Status'      => ucfirst($report->status),
                ];
            });

        $this->rowNumber = $collection->count() + 1;
        return $collection;
    }

    public function headings(): array
    {
        return [
            'Reported By',
            'Location',
            'Description',
            'Date & Time',
            'Submitted At',
            'Status'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->rowNumber + 1;

        // Borders
        $sheet->getStyle('A1:F' . $this->rowNumber)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Header bold
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Text wrap
        $sheet->getStyle('A1:F' . $rowCount)->getAlignment()->setWrapText(true);

        // Center vertically
        $sheet->getStyle('A1:F' . $this->rowNumber)
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Row height
        for ($i = 1; $i <= $rowCount; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }

        return [];
    }
}
