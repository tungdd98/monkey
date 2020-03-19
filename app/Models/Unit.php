<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
     * $table: tên bảng tham chiếu
     * $fillable: các field được cập nhật
     * $columns: các field được lựa chọn lấy thông tin
     * $folderImg: đường dẫn chứa ảnh
     */
    protected $table = 'units';
    protected $fillable = ['title', 'note', 'created_by', 'updated_by', 'created_at', 'updated_at', 'status'];
    protected $columns = ['id', 'title', 'note', 'created_by', 'updated_by', 'created_at', 'updated_at', 'status'];

    public function products() {
        return $this->hasMany('App\Models\Product');
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

    /**
     * Lưu dữ liệu
     * 
     * @param $request: thông tin requests
     * @param $options: tên task
     * @return void
     */
    public function saveItem($request, $options) {
        $params = $request->all();
        // Update status
        if($options['field'] == 'status') {
            self::where('id', $params['id'])->update(['status' => $params['status']]);
        }
        // Thêm phần tử mới
        if($options['field'] == 'add-item') {
            $this->create($params);
        }
        // Update phần tử
        if($options['field'] == 'update-item') {
            self::where('id', $params['id'])->update([
                'title' => $params['title'],
                'note'  => $params['note'],
                'status'=> $params['status'],
                'updated_by' => $params['updated_by']
            ]);
        }
    }

    /**
     * Xoá phần tử
     * 
     * @param $params
     * @param $options
     * @return void
     */
    public function deleteItem($request, $options) {
        if($options['task'] == 'item') {
            self::where('id', $request->id)->delete();
        }
    }

    /**
     * Lấy phần tử theo id
     * 
     * @param $requests
     * @return void
     */
    public function getItemById($request) {
        return self::select($this->columns)->where('id', $request->id)->first();
    }
}
