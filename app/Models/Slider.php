<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $columns = ['title', 'description', 'content', 'thumbnail', 'link', 'created_by', 'created_at', 'updated_by', 'updated_at'];

    public function getListItems($params = null, $options = null) {
        $result = null;
        if($options['list'] == 'all') {
            $result = self::select($this->columns)->get();
        }
        return $result;
    }
}
