<?php

namespace Botble\Miss\Exports;

use Botble\Base\Enums\BaseStatusEnum;
use Maatwebsite\Excel\Events\Event;
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

    //only draw image if != placeholder
    protected function drawImg(Event $event, string $column, int $row){
        $image = $event->sheet->getDelegate()
        ->getCell($column . $row)
        ->getValue();
        // dd(strcmp($image, '/vendor/core/core/base/images/placeholder.png'));
        if (strcmp($image, '/vendor/core/core/base/images/placeholder.png') != 0) {
            $this->drawingImage($event, $column, $row);
        } else {
            $event->sheet->getDelegate()
                ->getCell($column . $row)
                ->setValue('');
        }
    }

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
            // dd($event);
            $event->sheet->getDelegate()->getStyle('A'.$index.':AB'.$index)
            ->applyFromArray($index % 2 == 0 ? $style1 : $style2);

            $this->drawImg($event, 'B', $index);
            $this->drawImg($event, 'C', $index);
            $this->drawImg($event, 'D', $index);
            $this->drawImg($event, 'V', $index);
            $this->drawImg($event, 'W', $index);
            $this->drawImg($event, 'X', $index);
            $this->drawImg($event, 'Y', $index);
            $this->drawImg($event, 'Z', $index);
            $this->drawImg($event, 'AA', $index);

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
