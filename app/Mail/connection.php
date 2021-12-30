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
        if($n){
            $this->user=$user;
        } else {
            //$this->u[1] = $company;
            //$this->u[2] = $user;
        }
        /*$this->user=$user;*/
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->user->type==1) {
            $this->subject('I\'m Interested In Your Position!');
            $this->to($this->user->compEmail);
        }
        /*else {
            //$this->title('We Want You!');
            $this->subject('Mr/s '.$this->user2->name.' '.$this->user2->lastName.'<br>We would like to inform that we want you to work with us, if you are interested respond us.<br>From '.$this->user1->name);
            //$this->from(address: $this->user1->email);
            $this->to(address: $this->user2->email);
        }*/
        //return $this->view('mail',['user'=>$this]);

        /*$this->subject('Subject');
        $this->to($this->user1->email,$this->user1->name);*/

        return $this->view('mail.mailToEmp',['user'=>$this->user]);
    }
}
