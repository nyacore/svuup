<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CallRepository;
use App\Http\Controllers\Controller;

class CallController extends Controller
{
    protected $rep;

    public function __construct(CallRepository $call)
    {
        $this->rep = $call;
    }

    public function index()
    {
       return response()->json($this->rep->getListCall(), 200);
    }

    public function store(Request $requset){
        return response()->json($this->rep->getSaveCall($requset), 200);
    }

    public function edit(int $id){
        return response()->json($this->rep->findCall($id), 200);
    }

    public function update(Request $requset){
        return response()->json($this->rep->getUpdateCall($requset), 200);
    }

    public function destroy(int $id)
    {
        $this->rep->deleteCall($id);
        return response()->json([], 410);
    }
}