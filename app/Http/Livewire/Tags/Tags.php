<?php

/**
 * @author MDITech <mditech.net@gmail.com>
 */

namespace App\Http\Livewire\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;

    public $title, $tag_id;
    public $isOpen = 0;

    public function render()
    {
        //$this->tags = Tag::orderBy('id', 'desc')->paginate();
        //return view('livewire.tags.tags');

        return view('livewire.tags.tags', [
            'tags' => Tag::orderBy('id', 'desc')->paginate(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);

        Tag::updateOrCreate(['id' => $this->tag_id], [
            'title' => $this->title,
        ]);

        session()->flash(
            'message',
            $this->tag_id ? 'Tag Updated Successfully.' : 'Tag Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Tag::find($id)->delete();
        session()->flash('message', 'Tag Deleted Successfully.');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $this->tag_id = $id;
        $this->title = $tag->title;

        $this->openModal();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->tag_id = '';
    }
}