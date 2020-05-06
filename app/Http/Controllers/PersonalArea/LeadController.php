<?php

namespace App\Http\Controllers\PersonalArea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LeadContacts;
use App\Http\Controllers\Auth\AuthController;

class LeadController extends Controller
{

    protected $rep;
    protected $auth;

    public function __construct(LeadContacts $leadsRep, AuthController $auth)
    {
        $this->rep = $leadsRep;
        $this->auth = $auth;
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return $this->rep->getLeadList();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return $this->auth->me();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = $this->rep->getCreateLeadContact($request);
        return response()->json($obj, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json($this->rep->getLeadById($id),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {   $obj =$this->rep->getUpdateLeadContact($request, $id);
        return response()->json($obj,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $this->rep->destroyLeadById($id);
    return response()->json([],410);
    }
}
