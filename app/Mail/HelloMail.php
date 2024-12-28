<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fname;
    public $user_id;
    public $password;

    public function __construct($fname, $user_id, $password)
    {
        $this->fname = $fname;
        $this->user_id = $user_id;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('auth.hello')
                    ->with([
                        'email' => $this->fname,
                        'user_id' => $this->user_id,
                        'password' => $this->password,
                    ]);
    }
}
