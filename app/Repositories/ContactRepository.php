<?php

namespace App\Repositories;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ContactRepository extends Controller{

    protected $model;

    public function __construct(Lead $lead)
    {
        $this->model = $lead;
    }

    public function getContactsList(){
        $array =[];
        $leads = auth('api')->user()->leads()->get();
        foreach($leads as $obj){
            $array[] =[
                'name' =>$obj['name'],
                'last_call'=> $this->model->last_call->latest(),
                'responsible' =>$obj['responsible'], 
            ];
        };
        return $array;
    }


} 