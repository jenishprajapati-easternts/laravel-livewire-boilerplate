<?php

namespace App\Http\Livewire;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsersDatatables extends LivewireDatatable
{

    public $hideable = 'select';
    public $exportable = true;

    public function builder()
    {
        return User::query()->where('user_type', '!=', '0');
    }

    public function columns()
    {
        return [


            Column::name('first_name')->searchable(),
            Column::name('last_name')->searchable(),
            Column::name('email')->searchable(),
            Column::name('mobile_no')->searchable(),
            DateColumn::name('dob'),
            DateColumn::name('created_at'),

            Column::callback(['id', 'first_name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
        ];
    }
}
