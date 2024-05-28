<?php

namespace App\Exports;

use App\Models\CareerForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportCareerForm implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CareerForm::with('businessDetail','showroomDetail','serviceCenterDetail','bodyShopDetail')->get();
    }

    public function map($row) : array
    {
        return[
            $row->id,
            isset($row->businessDetail->title) && $row->businessDetail->title ? $row->businessDetail->title : '',
            isset($row->showroomDetail->name) && $row->showroomDetail->name ? $row->showroomDetail->name : '',
            isset($row->serviceCenterDetail->name) && $row->serviceCenterDetail->name ? $row->serviceCenterDetail->name : '',
            isset($row->bodyShopDetail->name) && $row->bodyShopDetail->name ? $row->bodyShopDetail->name : '',
            $row->first_name,
            $row->last_name,
            $row->contact_no,
            $row->email,
            $row->post_apply_for,
        ];
    }

    public function headings(): array
    {
        return ["Id","Business","Showroom","Service Center","Body Shop","First Name","Last Name","Contact No","Email","Post Apply For"];
    }
}
