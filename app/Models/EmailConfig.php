<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'mail_host',
        'smtp_username',
        'smtp_password',
        'mail_port',
        'mail_encryption',
    ];
}
