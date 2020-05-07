<?php

namespace App\Http\Controllers\PersonalArea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskContacts;
use App\Http\Controllers\Auth\AuthController;

class TaskController extends Controller
{

    protected $rep;
    protected $auth;

    public function __construct(TaskContacts $tasksRep, AuthController $auth)
    {
        $this->rep = $tasksRep;
        $this->auth = $auth;
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->rep->getTaskList(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json($this->auth->me(),200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = $this->rep->getCreateTaskContact($request);
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
        return response()->json($this->rep->getTaskById($id),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {   
        $obj = $this->rep->getTaskById($id);
        $obj = $this->rep->destroyTaskById($id);
        return response()->json($this->rep->getTaskById($id),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $this->rep->destroyTaskById($id);
    }
}
