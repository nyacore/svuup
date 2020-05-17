<?php
namespace App\Http\Controllers\PersonalArea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PhoneContacts;
use App\Http\Controllers\Auth\AuthController;

class PhoneController extends Controller
{

    protected $rep;


    public function __construct(PhoneContacts $phoneRep)
    {
        $this->rep = $phoneRep;
    }

    public function index()
    {
        return response()->json($this->rep->getPhoneList(), 200);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        return response()->json($this->rep->getCreatePhone(), 200);
    }

    public function update(Request $request)
    {
        return response()->json($this->rep->getUpdatePhone($request), 200);
    }

    public function delete(Request $request)
    {
        $this->rep->destroyPhone($request->id);
        return response()->json([], 410);
    }

    public function edit(Request $request)
    {
        return response()->json($this->rep->findPhone($request->id), 200);        
    }
}
