<?php

namespace App\Repositories;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PhoneContacts extends Controller
{
    protected $model;

    public function __construct(Phone $lead)
    {
        $this->model = $lead;
    }


    public function getPhoneList()
    {   $id = auth('api')->user()->id;
        return $this->model->where('lead_id',$id)->get();
    }

    public function getCreatePhone(Request $request)
    {
        return $this->model->save(new Phone($phone->all()));
    }

    public function getUpdatePhone(Request $request)
    {
        $phone = $this->findPhone($request->id);
        $phone->update($request->all());
        return $phone;
    }

    public function findPhone(int $id){
        return $this->model->find($id);
    }

    public function destroyPhone(int $id):void
    {
        $phone = $this->findPhone($id);
        $phone->delete();
    }
}