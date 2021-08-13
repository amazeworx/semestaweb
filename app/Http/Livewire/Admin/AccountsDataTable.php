<?php

namespace App\Http\Livewire\Admin;

use App\Models\OpenAccount;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class AccountsDataTable extends LivewireDatatable
{
  public $model = OpenAccount::class;
  public $hideable = 'select';
  public $exportable = true;

  public function columns()
  {
    return [
      NumberColumn::name('id'),
      Column::callback(['id', 'email'], function ($id, $email) {
        return view('admin.accounts.column-actions', ['id' => $id, 'email' => $email]);
      })->label('Actions'),
      Column::name('full_name')->label('Full Name')->searchable(),
      Column::name('nationality')->label('Nationality'),
      Column::name('id_type')->label('ID Type'),
      Column::name('email')->label('Email'),
      Column::name('ktp_number'),
      Column::name('ktp_expired_date'),
      Column::name('passport_number'),
      Column::name('passport_expired_date'),
      Column::name('kitas_number'),
      Column::name('kitas_expired_date'),
      Column::name('npwp_number'),
      Column::name('npwp_issue_date'),
      DateColumn::name('created_at'),
    ];
  }
}
