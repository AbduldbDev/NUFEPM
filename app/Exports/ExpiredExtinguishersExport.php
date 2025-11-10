<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ExpiredExtinguishersExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $datas;
    private $rowNumber = 0;

    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    public function collection()
    {
        $collection = collect($this->datas)
            ->filter(function ($data) {
                return Carbon::parse($data->life_span)->isPast();
            })
            ->map(function ($data) {
                return [
                    'Extinguisher ID' => $data->extinguisher_id,
                    'Type' => $data->type ?? '',
                    'Location' => $data->location
                        ? implode(', ', array_filter([
                            $data->location->building,
                            $data->location->floor,
                            $data->location->room,
                            $data->location->spot,
                        ]))
                        : '',
                    'Serial Number' => $data->serial_number,
                    'Capacity' => $data->capacity,
                    'Expiration' => Carbon::parse($data->life_span)->format('F j, Y'),
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
            'Capacity',
            'Expiration',
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
