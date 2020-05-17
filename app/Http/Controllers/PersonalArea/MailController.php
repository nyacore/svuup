<?php
namespace App\Http\Controllers\PersonalArea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MailContacts;
use App\Http\Controllers\Auth\AuthController;

class MailController extends Controller
{

    protected $rep;

    public function __construct(MailContacts $mailCont)
    {
        $this->rep = $mailCont;
    }

    public function index()
    {
        return response()->json($this->rep->getMailList(), 200);
    }

    public function store(Request $request)
    {
        return response()->json($this->rep->getSaveMail($request), 200);
    }
    public function update(Request $request)
    {
        return response()->json($this->rep->getUpdateMail($request), 200);
    }

    public function edit($id)
    {
        return response()->json($this->rep->findMail($id), 200);
    }

    public function destroy($id)
    {
        $this->rep->deleteMail($id);
        return response()->json([], 410);
    }
}
