<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Equipment;
use Carbon\Carbon;

class AllEquipmentCertificatesExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    private $rowNumber = 0;

    public function collection()
    {
        $collection = Equipment::with(['location', 'latestCertificate'])
            ->get()
            ->map(function ($equipment) {

                $certificate = $equipment->latestCertificate;

                return [
                    'Type'           => $equipment->type,
                    'Model'          => $equipment->model,
                    'Serial Number'  => $equipment->serial_number,
                    'Location'       => $equipment->location
                        ? implode(', ', array_filter([
                            $equipment->location->building,
                            $equipment->location->floor,
                            $equipment->location->room,
                            $equipment->location->spot,
                        ]))
                        : '',

                    'Certificate No' => $certificate->certificate_no ?? 'No Certificate',
                    'Issue Date'     => $certificate && $certificate->issue_date
                        ? Carbon::parse($certificate->issue_date)->format('F j, Y')
                        : 'N/A',

                    'Expiry Date'    => $certificate && $certificate->expiry_date
                        ? Carbon::parse($certificate->expiry_date)->format('F j, Y')
                        : 'N/A',
                ];
            });

        $this->rowNumber = $collection->count() + 1;
        return $collection;
    }

    public function headings(): array
    {
        return [
            'Type',
            'Model',
            'Serial Number',
            'Location',
            'Certificate No',
            'Issue Date',
            'Expiry Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->rowNumber + 1;

        $sheet->getStyle('A1:G' . $this->rowNumber)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G' . $rowCount)->getAlignment()->setWrapText(true);

        $sheet->getStyle('A1:G' . $this->rowNumber)
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        for ($i = 1; $i <= $rowCount; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }

        return [];
    }
}
