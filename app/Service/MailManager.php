<?php

namespace App\Service;

use App\Mail\CatalogExportMail;
use Illuminate\Support\Facades\Mail;

class MailManager
{
    public static function sendMail()
    {
        Mail::to(config("catalogVariables.adminMail"))
            ->send(new CatalogExportMail(config("catalogVariables.successfulExportMessage")));
    }
}
