<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\hoadon;

class ExcelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$hoadon = hoadon::all();
        return $hoadon;
    }
     public function headings(): array
    {
        return [
            'STT',
            'Mã hóa đơn',
            'Tên đơn vị',
            'Địa chỉ',
            'Số điện thoại',
            'Ngày tháng',
            'Thành tiền'
        ];
    }
}
