<?php

namespace App\Exports;

use App\Models\PayUs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPayment implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PayUs::all();
    }

    public function map($row) : array
    {
        return[
            $row->id,
            $row->payment_to,
            $row->payment_towards,
            $row->location,
            $row->name,
            $row->mobile_no,
            $row->emailid,
            $row->registeration_no,
            $row->near_location,
            $row->paid_amount,
            $row->transaction_time,
        ];
    }

    public function headings(): array
    {
        return ["Id","Payment To","Payment Towards","Location","Name","Mobile No","Email","Registration No","Address","Paid Amount","Transaction Time"];
    }
}
