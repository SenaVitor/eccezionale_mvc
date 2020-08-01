<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMessage;
 
class ContactFormMessage extends Mailable{
    use Queueable, SerializesModels;
 
 
    public function __construct(){
        //
    }
 
 
    public function build(Request $request){
         
        return $this->from([
                'address' => $request->email, 
                'name' => $request->name 
            ])
            ->to( env('APP_ADMIN_CONTACT') )
            ->subject( 'Message from website: ' . $request->subject )
            ->view('contactform')
            ->with([    
                'contactName' => $request->name,
                'contactSubject' => $request->subject,
                'contactEmail' => $request->email,
                'contactMessage' => $request->message
            ]);
 
    }
}