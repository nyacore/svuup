<?php

namespace App\Repositories;

use App\Model\Leads;
use Illuminate\Support\Facades\DB;

class LeadsContacts extends Leads
{
    protected $model;

    public function __construct(Leads $leads){
        $this->model = $leads;
    }
}