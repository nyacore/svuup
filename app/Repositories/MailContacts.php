<?php 

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Mail;

class MailContacts extends Controller
{
    protected $model;
    public function __construct(Mail $mail)
    {
        $this->model = $mail;
    }

    public function getMailList()
    {
        $id = auth('api')->user()->id;
        return $this->model->where('lead_id', $id)->get();
    }

    public function getSaveMail(Request $request)
    {
        return $this->model->save(new Mail($request->all()));
    }

    public function getUpdateMail(Request $request)
    { 
        $object = $this->findMail($request->id);
        return $object->update($request->all());
    }

    public function findMail(int $id)
    {
        return $this->model->find($id);
    }

    public function deleteMail(int $id):void
    {
        $object = $this->findMail($id);
        $object->delete();
    }
}