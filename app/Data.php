<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Data extends Model
{
    protected $fillable = ['date', 'value'];
}
