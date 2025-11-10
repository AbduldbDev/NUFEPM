<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\ExtinguisherRefill;
use Carbon\Carbon;

class RefillLogs implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $datas;
    private $rowNumber = 0;

    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    public function collection()
    {
        $collection = collect($this->datas)->map(function ($data) {
            return [
                'Extinguisher ID' => $data->extinguisher->extinguisher_id ?? '',
                'Type'            => $data->extinguisher->type ?? '',
                'Capacity'        => $data->extinguisher->capacity ?? '',
                'Location'        => $data->extinguisher->location
                    ? implode(', ', array_filter([
                        $data->extinguisher->location->building,
                        $data->extinguisher->location->floor,
                        $data->extinguisher->location->room,
                        $data->extinguisher->location->spot
                    ]))
                    : '',
                'Serial Number'   => $data->extinguisher->serial_number ?? '',
                'Refilled By'     => $data->user ? $data->user->fname . ' ' . $data->user->lname : '',
                'Refill Date'     => Carbon::parse($data->refill_date)->format('F j, Y'),
                'Remarks'         => $data->remarks ?? '',
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
            'Capacity',
            'Location',
            'Serial Number',
            'Refilled By',
            'Refill Date',
            'Remarks',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->rowNumber + 1;

        $sheet->getStyle('A1:H' . $this->rowNumber)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H' . $rowCount)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:H' . $this->rowNumber)
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        for ($i = 1; $i <= $rowCount; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }

        return [];
    }
}
