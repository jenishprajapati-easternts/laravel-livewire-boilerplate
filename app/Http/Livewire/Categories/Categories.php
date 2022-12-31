<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{

    public $categories, $name, $color, $category_id;
    public $isOpen = 0;
    
    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.categories.categories');
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
        ]);
        
        Category::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'color' => $this->color
        ]);
        
        session()->flash('message', $this->category_id ? 'Category Updated Successfully.' : 'Category Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }
    
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        Category::find($id)->delete();
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
    }
}