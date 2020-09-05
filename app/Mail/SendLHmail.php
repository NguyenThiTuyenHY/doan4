<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLHmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name, $tieude, $email, $sdt, $content; 
    public function __construct($data)
    {
        $this->name = $data->txthoten;
        $this->tieude = $data->txttd;
        $this->email = $data->txtemail;
        $this->sdt = $data->txtdt;
        $this->content = $data->txtnd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->subject($this->tieude)->view('user.pages.sendLHmail',['name'=>$this->name,'sdt'=>$this->sdt,'content'=>$this->content]);
    }
}
