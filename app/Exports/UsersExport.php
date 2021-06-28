<?php

namespace App\Exports;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromCollection
{

  private $userFields;

  public function __construct($userFields = null)
  {
    $this->userFields = $userFields;
  }

  use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

      return $this->userFields ?: User::all();
  
    }

 
}
