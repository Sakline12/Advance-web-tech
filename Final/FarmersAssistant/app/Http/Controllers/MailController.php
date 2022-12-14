<?php
//php artisan make:controller MailController
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendmail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class MailController extends Controller
{
    function index()
    {
     return view('mail');
    }

    function send(Request $request)
    {
        $admin="admin@aiub.edu";

        $this->validate($request,
        ['email'=>'email|required',
        'subject' => 'required',
        'message'=>'required',
                ]
        );
        if(isset($error))
        {

        }
        $data = array(
            'email'=>$request->email,
            'subject'=> $request->subject,
            'message'=>$request->message
        );

     Mail::to($admin)->send(new SendMail($data));
     return back()->with('success', 'Thanks for contacting us!');

    }

}
