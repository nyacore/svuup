<?php

namespace App\Repositories;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LeadContacts extends Controller
{
    protected $model;

    public function __construct(Lead $lead){
        $this->model = $lead;
    }

    public function getLeadList(){
        return  auth('api')->user()->leads;
    }

    public function getCreateLeadContact($data):object
    { 
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

    public function getUpdateLeadContact(Request $request, int $id):object
    {
        $obj = $this->getLeadById($id);
        $obj['user_id'] = $request['user_id'];
        $obj['name']    = $request['name'];
        $obj['phones']  = $request['phones'];
        $obj['emails']  = $request['emails'];
        $obj['sites']   = $request['sites'];
        $obj['city']    = $request['city'];
        $obj['street']  = $request['street'];
        $obj['region']  = $request['region'];
        $obj['activity']= $request['activity'];
        $obj['INN']     = $request['INN'];
        $obj['KPP']     = $request['KPP'];
        $obj['tags']    = $request['tags'];
        $obj['desc']    = $request['desc'];
        $obj['responsible']= $request['responsible'];
        $obj->update();
        return $obj;   
    } 
}