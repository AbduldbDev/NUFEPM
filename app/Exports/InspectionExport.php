<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\InspectionLogs;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InspectionExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $logs;
    protected $startDate;
    protected $endDate;
    private $rowNumber = 0;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        return collect($this->logs)->map(function ($log) {
            return [
                'Extinguisher ID' => $log->extinguisher->extinguisher_id,
                'Type' => $log->extinguisher->type->name ?? '',
                'Location' => $log->extinguisher->location
                    ? implode(', ', array_filter([
                        $log->extinguisher->location->building,
                        $log->extinguisher->location->floor,
                        $log->extinguisher->location->room,
                        $log->extinguisher->location->spot,
                    ]))
                    : '',
                'Serial Number' => $log->extinguisher->serial_number,
                'Inspected By' => $log->user->lname . ', ' . $log->user->fname,
                'Inspected At' => \Carbon\Carbon::parse($log->inspected_at)->format('F j Y g:ia'),
                'Next Due' => \Carbon\Carbon::parse($log->next_due)->format('F j Y'),
                'Time' => gmdate(
                    $log->time > 3600 ? 'H:i:s' : ($log->time >= 60 ? 'i:s' : 's'),
                    $log->time
                ) . ' ' . ($log->time > 3600 ? 'Hr' : ($log->time >= 60 ? 'Min' : 'Sec')),
                'Status' => $log->status,
                'Remarks' => $log->remarks,
                'Answers' => $log->answers->map(
                    fn($a) => "Question: {$a->questions->question}\n Answer: {$a->answer}"
                )->implode("\n\n"),
            ];
        });

        $this->rowNumber = $collection->count() + 1;

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Extinguisher ID',
            'Type',
            'Location',
            'Serial Number',
            'Inspected By',
            'Inspected At',
            'Next Due',
            'Time (sec)',
            'Status',
            'Remarks',
            'Answers',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->rowNumber + 1;

        $sheet->getStyle('A1:K' . $this->rowNumber)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('A1:K' . $rowCount)->getFont()->setName('Arial');
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
        $sheet->getStyle('A:K')->getFont()->setSize(12);
        $sheet->getStyle('A1:O1')->getFont()->setSize(12);

        $sheet->getStyle('A1:K1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:A')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D:D')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G:G')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:K' . $rowCount)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:K' . $this->rowNumber)
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        for ($i = 1; $i <= $rowCount; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }
        return [];
    }
}
