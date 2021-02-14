<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //$guarded 変更しないカラム
    protected $guarded = [
        'id'
    ];
}
