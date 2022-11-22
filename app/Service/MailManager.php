<?php

namespace App\Service;

use App\Mail\CatalogExportMail;
use Illuminate\Support\Facades\Mail;

class MailManager
{
    public static function sendMail()
    {
        Mail::to('artsiom.danchykau@innowise-group.com')->send(new CatalogExportMail('It works!'));
    }
}
