<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
