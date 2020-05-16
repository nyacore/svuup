<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TaskContacts extends Controller
{
    protected $model;

    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function getTaskList($request)
    {
        return auth('api')->user()->tasks()->with('lead')->paginate(10);
    }

    public function getCreateTaskContact($data): object
    {
        $task = new Task();
        $task['lead_id'] = $data['lead_id'];
        $task['date']    = $data['date'];
        $task['type']  = $data['type'];
        $task['contact']  = $data['contact'];
        $task['performer']   = $data['performer'];
        $task['comment']    = $data['comment'];
        $task->save();
        return $task;
    }

    public function getTaskById(int $id)
    {
        return $this->model->find($id);
    }

    public function destroyTaskById(int $id): void
    {
        $this->getTaskById($id)->delete();
    }

    public function getUpdateTaskContact(int $id, Request $request)
    {
        $task = $this->getTaskById($id);
        $task['lead_id'] = $request['lead_id'];
        $task['user_id'] = $request['user_id'];
        $task['date']    = $request['date'];
        $task['type']  = $request['type'];
        $task['contact']  = $request['contact'];
        $task['performer']   = $request['performer'];
        $task['comment']    = $request['comment'];
        $task->update();
        return $task;
    }
}
