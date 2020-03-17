<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * $table: tên bảng tham chiếu
     * $fillable: các field được cập nhật
     * $columns: các field được lựa chọn lấy thông tin
     * $folderImg: đường dẫn chứa ảnh
     */
    protected $table = 'categories';
    protected $fillable = ['title', 'parent_id', 'description', 'content', 'thumbnail', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $columns = ['id', 'title', 'description', 'content', 'thumbnail', 'parent_id', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $folderImg = 'category';

    /**
     * Quan hệ với bảng sản phẩm (nhiều - nhiều)
     */
    public function products() {
        return $this->belongstoMany('App\Models\Product');
    }
    /**
     * Lấy danh sách phần tử
     * 
     * @param $params: thông tin requests
     * @param $options: tên task
     * @return array
     */
    public function getListItems($params = null, $options = null) {
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
        if($options['field'] == 'status') {
            self::where('id', $params['id'])->update(['status' => $params['status']]);
        }
        if($options['field'] == 'add-item') {
            if($request->hasFile('thumbnail')) {
                $imgName = time() . $params['thumbnail']->getClientOriginalName();
                $params['thumbnail']->move("images/{$this->folderImg}", $imgName);
                $params['thumbnail'] = $imgName;
            }
            $this->create($params);
        }
        if($options['field'] == 'update-item') {
            if($request->hasFile('thumbnail')) {
                $imgPath = "images/{$this->folderImg}/{$params['currThumbnail']}";
                unlink($imgPath);
                $imgName = time() . $params['thumbnail']->getClientOriginalName();
                $params['thumbnail']->move("images/{$this->folderImg}", $imgName);
                $params['thumbnail'] = $imgName;
            }
            self::where('id', $params['id'])->update([
                'title'         => $params['title'],
                'description'   => $params['description'],
                'content'       => $params['content'],
                'parent_id'     => $params['parent_id'],
                'thumbnail'     => $params['thumbnail'],
                'status'        => $params['status'],
                'updated_by'    => $params['updated_by']
            ]);
        }
    }

    /**
     * Xoá phần tử
     * 
     * @param $params: thông tin requests
     * @param $options: tên task
     * @return void
     */
    public function deleteItem($params, $options) {
        if($options['task'] == 'item') {
            self::where('id', $params['id'])->delete();
        }
    }

    /**
     * Lấy phần tử theo id
     * 
     * @param $params: thông tin requests
     * @return void
     */
    public function getItemById($params, $options = null) {
        if(isset($options['columns'])) {
            return self::select($options['columns'])->where('id', $params['id'])->first();
        }
        return self::select($this->columns)->where('id', $params['id'])->first();
    }
}
