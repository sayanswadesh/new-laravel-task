<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';
    protected $fillable = [
        'site_logo',
        'site_icon',
        'signIn_backgroundImage',
        'app_title'
    ];
    protected $visible = [
        'site_logo',
        'site_icon',
        'signIn_backgroundImage',
        'app_title'
    ];
    public $timestamps = true;
}
