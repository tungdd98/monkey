<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $fillable = ['customer_id', 'status', 'user_id', 'total', 'quantity', 'updated_at', 'created_at'];
    protected $columns = ['id', 'customer_id', 'status', 'user_id', 'total', 'quantity', 'updated_at', 'created_at'];

    public function products() {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }

    public function users() {
        return $this->belongsTo('App\Models\User');
    }

    public function customers() {
        return $this->belongsTo('App\Models\Customer');
    }
    /**
     * Lấy danh sách phần tử
     * 
     * @param $options: tham số truyền vào
     * @return array
     */
    public function getListItems($options = null) {
        $result = null;
        if($options['pagination'] == 'false') {
            $result = self::select($this->columns)->orderBy($options['order_by'], $options['order_dir'])->get();
        } else {
            $result = self::select($this->columns)
                            ->orderBy($options['order_by'], $options['order_dir'])
                            ->paginate($options['per_page']);
        }
        return $result;
    }
}
