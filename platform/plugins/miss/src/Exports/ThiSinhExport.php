<?php

namespace Botble\Miss\Exports;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Table\Supports\TableExportHandler;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ThiSinhExport extends TableExportHandler
{
    /**
     * {@inheritDoc}
     */
    protected function afterSheet(AfterSheet $event)
    {
        parent::afterSheet($event);

        $totalRows = $this->collection->count() + 1;

        // $event->sheet->getDelegate()
        //     ->getStyle('F1:F' . $totalRows)
        //     ->getAlignment()
        //     ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // $event->sheet
        //     ->getDelegate()
        //     ->getStyle('C1:C' . $totalRows)
        //     ->getAlignment()
        //     ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // $event->sheet->getDelegate()
        //     ->getColumnDimension('C')
        //     ->setWidth(40);

        for ($index = 2; $index <= $totalRows; $index++) {

            $style1 = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'dce6f1',
                    ]
                ],
            ];
            $style2 = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                // 'fill' => [
                //     'fillType' => Fill::FILL_SOLID,
                //     'startColor' => [
                //         'argb' => 'dce6f1',
                //     ]
                // ],
            ];

            $event->sheet->getDelegate()->getStyle('A'.$index.':AB'.$index)
            ->applyFromArray($index % 2 == 0 ? $style1 : $style2);

            $this->drawingImage($event, 'B', $index);
            $this->drawingImage($event, 'C', $index);
            $this->drawingImage($event, 'D', $index);
            $this->drawingImage($event, 'V', $index);
            $this->drawingImage($event, 'W', $index);
            $this->drawingImage($event, 'X', $index);
            $this->drawingImage($event, 'Y', $index);
            $this->drawingImage($event, 'Z', $index);
            $this->drawingImage($event, 'AA', $index);

            $ten_truong = $event->sheet->getDelegate()
                ->getStyle('G' . $index)
                ->getFont()
                ->getColor();

            $value = $event->sheet->getDelegate()
                ->getCell('G' . $index)
                ->getValue();

            if (strcasecmp($value,'Đại học Bà Rịa - Vũng Tàu')==0) {
                $ten_truong->setARGB('c00000');
            } else if (strcasecmp($value,'Đại học Gia Định')==0) {
                $ten_truong->setARGB('00b050');
            } else if (strcasecmp($value,'Đại học Quốc tế Hồng Bàng')==0) {
                $ten_truong->setARGB('0070c0');
            } else if (strcasecmp($value,'Đại học Hoa Sen')==0) {
                $ten_truong->setARGB('7030a0');
            } else {
                $ten_truong->setARGB('e36c09');
            }

        }
    }
}
