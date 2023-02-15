<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;


    /**
     * configure
     *
     * @return void
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setFilterLayoutSlideDown();
    }

    /**
     * columns
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Color", "color")
                ->sortable()
                ->searchable(),

            Column::make("Status", "status")
                ->format(
                    fn ($value, $row, Column $column) => $value == '1' ? 'Active' : 'Deactive'
                )->sortable()
                ->searchable(),

            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Updated at", "updated_at")
                ->sortable()
                ->searchable(),

            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button wire:click="deleteCategory(' . $row->id . ')" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Delete
                            </button>';
                        $edit = '<button wire:click="edit(' . $row->id . ')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Edit
                    </button>';
                        return $edit . $delete;
                    }
                )->html(),


        ];
    }

    /**
     * bulkActions
     *
     * @return array
     */
    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
        ];
    }

    /**
     * activate
     *
     * @return void
     */
    public function activate()
    {
        Category::whereIn('id', $this->getSelected())->update(['status' => '1']);

        $this->clearSelected();
    }

    /**
     * deactivate
     *
     * @return void
     */
    public function deactivate()
    {
        Category::whereIn('id', $this->getSelected())->update(['status' => '0']);

        $this->clearSelected();
    }

    /**
     * filters
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->setFilterPillTitle('Status')
                ->setFilterPillValues([
                    '1' => 'Active',
                    '0' => 'Deactive',
                ])
                ->options([
                    '' => 'All',
                    '1' => 'Active',
                    '0' => 'Deactive',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('status', '1');
                    } elseif ($value === '0') {
                        $builder->where('status', '0');
                    }
                }),
            DateFilter::make('Date From')
                ->config([
                    'min' => '2020-01-01',
                    'max' => '2021-12-31',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('created_at', '>=', $value);
                }),
            DateFilter::make('Date To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('created_at', '<=', $value);
                }),
        ];
    }
}
