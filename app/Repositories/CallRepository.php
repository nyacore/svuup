<?php

namespace App\Repositories;

use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CallRepository extends Controller
{
    protected $model;

    public function __construct(Call $call)
    {
        $this->model = $call;
    }

    public function getCallList(){
        $id = auth('api')->user()->id;
        return $this->model->where('id',$id)->get();
    }

    public function getSaveCall(Request $requset)
    {
        return $this->model->save(new Call($requset->all()));
    }

    public function getUpdateCall(Request $requset)
    {   
        $object = $this->findCall($requset->id);
        return $object->update($requset->all());
    }

    public function findCall(int $id)
    {
        return $this->model->find($id);
    }

    public function deleteCall(int $id):void
    {
        $object = $this->findCall($id);
        $object->delete();
    }
}