<?php

namespace Botble\Miss\Exports;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Table\Supports\TableExportHandler;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ThiSinhExport extends TableExportHandler
{
    /**
     * {@inheritDoc}
     */
    protected function afterSheet(AfterSheet $event)
    {
        parent::afterSheet($event);

        $totalRows = $this->collection->count() + 1;

        $event->sheet->getDelegate()
            ->getStyle('F1:F' . $totalRows)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $event->sheet
            ->getDelegate()
            ->getStyle('C1:C' . $totalRows)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $event->sheet->getDelegate()
            ->getColumnDimension('C')
            ->setWidth(40);

        for ($index = 2; $index <= $totalRows; $index++) {

            $this->drawingImage($event, 'D', $index);

            $ten_truong = $event->sheet->getDelegate()
                ->getStyle('F' . $index)
                ->getFont()
                ->getColor();

            $value = $event->sheet->getDelegate()
                ->getCell('F' . $index)
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

            // $event->sheet
            //     ->getDelegate()
            //     ->getCell('F' . $index)
            //     ->setValue(BaseStatusEnum::getLabel($value));
        }
    }
}
