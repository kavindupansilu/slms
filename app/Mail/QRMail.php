<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class QRMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fname;
    public $lname;
    public $student_id;
    public $degree_name;

    public function __construct($fname, $lname, $student_id, $degree_name)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->student_id = $student_id;
        $this->degree_name = $degree_name;
    }

    public function build()
    {
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data($this->student_id)
            ->size(200)
            ->build();
        
        $qrCodePath = 'qrcodes/' . $this->student_id . '.png';
        Storage::put($qrCodePath, $qrCode->getString());

        return $this->view('auth.qr')
                    ->with([
                        'fname' => $this->fname,
                        'lname' => $this->lname,
                        'student_id' => $this->student_id,
                        'degree_name' => $this->degree_name,
                    ])
                    ->attach(storage_path('app/' . $qrCodePath), [
                        'as' => 'qrcode.png',
                        'mime' => 'image/png',
                    ]);
    }
}
