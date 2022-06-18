<?php

namespace App\Exports;

use App\Models\Member;
use App\Http\Resources\MemberResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersExport implements FromCollection,WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection


    */

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
           // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
//            'C'  => ['font' => ['size' => 16]],
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'name',
            'member_no',
            'nationality',
            'field',
            'gravatar',
            'phone',
            'email',
            'contacts'
        ];
    }
    public function collection()
    {
        $members=MemberResource::collection(Member::all());
              return $members;
    }
}
