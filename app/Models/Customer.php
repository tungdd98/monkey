<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['name', 'email', 'address', 'phone', 'note', 'created_at', 'updated_at']; 
    protected $columns =  ['id', 'name', 'email', 'address', 'phone', 'note', 'created_at', 'updated_at'];

}
