<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use function Ramsey\Uuid\v1;

class connection extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * $n boolean - se true user sends to company, se false company sends to user
     * @return void
     */
    public function __construct($user/*,User $company*/,$n)
    {
        $this->user=$user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->user->type == 1) {
            $this->subject('I\'m Interested In Your Position!');
            $this->to($this->user->compEmail);
            return $this->view('mail.mailToEmp',['user'=>$this->user]);
        }
        else{
            $this->subject('We Would Like To Interview You');
            $this->to($this->user->userEmail);
            return $this->view('mail.mailToUser',['user'=>$this->user]);
        }
    }
}
