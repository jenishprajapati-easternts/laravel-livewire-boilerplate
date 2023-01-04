<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Categories extends Component
{

    use WithPagination;

    public $name, $color, $status, $category_id;
    public $isOpen = 0;

    public $confirmingCategoryDeletion = false;
    public $search = '';
    public $orderColumn = "name";
    public $sortOrder = "asc";
    public $sortLink = '<svg class="h-4 w-4 text-gray-800"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><polyline points="18 15 12 9 6 15" /></svg>';

    /**
     * updated
     *
     * @return void
     */
    public function updated()
    {
        $this->resetPage();
    }


    /**
     * sortOrder
     *
     * @param  mixed $columnName
     * @return void
     */
    public function sortOrder($columnName = "")
    {
        $caretOrder = "18 15 12 9 6 15";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = "6 9 12 15 18 9";
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = "18 15 12 9 6 15";
        }

        $this->sortLink = '<svg class="h-4 w-4 text-gray-800"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><polyline points="' . $caretOrder . '" /></svg>';

        $this->orderColumn = $columnName;
    }


    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
            'status' => ['required', Rule::in(['0', '1'])],
        ]);

        Category::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'color' => $this->color,
            'status' => $this->status
        ]);

        session()->flash('message', $this->category_id ? 'Category Updated Successfully.' : 'Category Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
        $this->emit('refreshDatatable');
    }


    /**
     * confirmItemDeletion
     *
     * @param  mixed $id
     * @return void
     */
    public function confirmCategoryDeletion($id)
    {
        $this->confirmingCategoryDeletion = $id;
    }

    /**
     * deleteItem
     *
     * @param  mixed $category
     * @return void
     */
    public function deleteCategory(Category $category)
    {
        $category->delete();
        $this->confirmingCategoryDeletion = false;
        session()->flash('message', 'Category Deleted Successfully.');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->color = $category->color;
        $this->status = $category->status;
        $this->openModal();
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * openModal
     *
     * @return void
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * closeModal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * resetInputFields
     *
     * @return void
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->color = '';
        $this->category_id = '';
        $this->status = '';
    }
}