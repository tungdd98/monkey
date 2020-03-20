<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{
    /**
     * $table: tên bảng tham chiếu
     * $fillable: các field được cập nhật
     * $columns: các field được lựa chọn lấy thông tin
     * $folderImg: đường dẫn chứa ảnh
     */
    protected $table = 'datatypes';
    protected $fillable = ['title', 'note', 'code'];
    protected $columns = ['id', 'title', 'note', 'code'];

}
