<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Inclusion;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    protected $categoryIds;

    public function __construct($categoryIds)
    {
        $this->categoryIds = $categoryIds;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (!empty($this->categoryIds)) {
            return  Category::select('name', 'color', DB::raw('(CASE WHEN status = "0" THEN "Deactive" WHEN status = "1" THEN "Active" ELSE ""  END) AS status'))
                ->whereIn('id', $this->categoryIds)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            return  Category::select('name', 'color', DB::raw('(CASE WHEN status = "0" THEN "Deactive" WHEN status = "1" THEN "Active" ELSE ""  END) AS status'))
                ->orderBy('id', 'DESC')
                ->get();
        }
    }

    public function headings(): array
    {
        return [
            'Name',
            'Color',
            'Status'
        ];
    }
}
