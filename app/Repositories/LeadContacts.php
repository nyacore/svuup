<?php

namespace App\Repositories;

use App\Models\Lead;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LeadContacts extends Controller
{
    protected $model;

    public function __construct(Lead $lead){
        $this->model = $lead;
    }

    public function getLeadList(){
        return $this->model->get();
    }

    public function getCreateLeadContact($data):object
    { dd(1);
        $contact = new Lead();
        $contact['user_id'] = $data['user_id'];
        $contact['name']    = $data['name'];
        $contact['phones']  = $data['phones'];
        $contact['emails']  = $data['emails'];
        $contact['sites']   = $data['sites'];
        $contact['city']    = $data['city'];
        $contact['street']  = $data['street'];
        $contact['region']  = $data['region'];
        $contact['activity']= $data['activity'];
        $contact['INN']     = $data['INN'];
        $contact['KPP']     = $data['KPP'];
        $contact['tags']    = $data['tags'];
        $contact['desc']    = $data['desc'];
        $contact['responsible']= $data['responsible'];
        $contact->save();
        return $contact;
    }

    public function getLeadById(int $id)
    {
        return $this->model->find($id);
    }

    public function destroyLeadById(int $id):void
    {
        $this->getLeadById($id)->delete();
    }

    public function getUpdateLeadContact(int $id, Request $request){
        
    } 
}