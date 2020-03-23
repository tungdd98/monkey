<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $fillable = ['customer_id', 'status', 'user_id', 'total', 'quantity', 'updated_at', 'created_at'];
    protected $columns = ['id', 'customer_id', 'status', 'user_id', 'total', 'quantity', 'updated_at', 'created_at'];

    public function products() {
        return $this->belongsToMany('App\Models\Product');
    }
}
