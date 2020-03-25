<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'password', 'email', 'address', 'phone', 'birthday', 'gender', 'status', 'avatar', 'level', 'created_at', 'updated_at', 'city', 'district', 'ward']; 
    protected $columns =  ['id', 'name', 'email', 'address', 'phone', 'birthday', 'gender', 'status', 'avatar', 'level', 'created_at', 'updated_at', 'city', 'district', 'ward']; 


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
                'name'      => $params['name'],
                'address'   => $params['address'],
                'phone'     => $params['phone'],
                'birthday'  => $params['birthday'],
                'gender'    => $params['gender'],
                'status'    => $params['status'],
                // 'avatar'    => $params['avatar'],
                'level'     => $params['level'],
                'city'      => $params['city'],
                'district'  => $params['district'],
                'ward'      => $params['ward'],
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
