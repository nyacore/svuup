<?php

namespace App\Repositories;

use App\Model\Leads;
use Illuminate\Support\Facades\DB;

class LeadsContacts extends Leads
{
    protected $model;

    public function __construct(Leads $leads){
        $this->model = $leads;
    }

    public function getCreateLeadsContact($data):object
    {
        $contact = new Leads();
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
        $contact['main']    = $data['main'];
        $contact->save();
    }
}