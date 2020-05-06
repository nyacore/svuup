<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TaskContacts extends Controller
{
    protected $model;

    public function __construct(Tasks $task){
        $this->model = $task;
    }

    public function getTaskList(){
        return $this->model->get();
    }

    public function getCreateTaskContact($data):object
    {
        $contact = new Task();
        $contact['lead_id'] = $data['lead_id'];
        $contact['date']    = $data['date'];
        $contact['type']  = $data['type'];
        $contact['contact']  = $data['contact'];
        $contact['performer']   = $data['performer'];
        $contact['comment']    = $data['comment'];
        $contact->save();
        return $contact;
    }

    public function getTaskById(int $id)
    {
        return $this->model->find($id);
    }

    public function destroyTaskById(int $id):void
    {
        $this->getTaskById($id)->delete();
    }

    public function getUpdateTaskContact(int $id, Request $request){
        
    } 
}