<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Inclusion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return  Category::select('name', 'color', 'status')->orderBy('id', 'DESC')->get();
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
