<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';
    protected $fillable = ['company', 'address', 'phone', 'hotline', 'time', 'copyright', 'fanpage', 'brief', 'facebook', 'gmail', 'twitter', 'google'];
    public $timestamps = false;
}
