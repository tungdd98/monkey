<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    // protected $guarded = [];
    /**
     * $table: tên bảng tham chiếu
     * $fillable: các field được cập nhật
     * $columns: các field được lựa chọn lấy thông tin
     * $folderImg: đường dẫn chứa ảnh
     */
    protected $table = 'categories';
    protected $fillable = ['title', 'parent_id', 'type', 'description', 'content', 'thumbnail', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $columns = ['id', 'title', 'parent_id', 'type', 'description', 'content', 'thumbnail', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $folderImg = 'category';

    /**
     * Quan hệ với bảng sản phẩm (nhiều - nhiều)
     */
    public function products() {
        return $this->belongstoMany('App\Models\Product');
    }

    /**
     * Quan hệ với bảng tin tức (nhiều - nhiều)
     */
    public function articles() {
        return $this->belongstoMany('App\Models\Article');
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
            if($request->hasFile('thumbnail')) {
                $imgName = time() . $params['thumbnail']->getClientOriginalName();
                $params['thumbnail']->move("images/{$this->folderImg}", $imgName);
                $params['thumbnail'] = $imgName;
            }
            $this->create($params);
        }
        // Update phần tử
        if($options['field'] == 'update-item') {
            if(!empty($request->currThumbnail)) {
                $imgPath = "images/{$this->folderImg}/{$params['currThumbnail']}";
                if(file_exists(public_path() . $imgPath)) {
                    unlink($imgPath);
                }
            }
            if($request->hasFile('thumbnail')) {
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
                'updated_by'    => $params['updated_by'],
                'type'          => $params['type']
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
    public function deleteItem($request, $options) {
        if($options['task'] == 'item') {
            self::where('id', $request->id)->delete();
            $this->deleteQueue($request->children);
        }
    }

    public function deleteQueue($items) {
        foreach($items as $key => $value) {
            self::where('id', $value['id'])->delete();
            $this->deleteQueue($value['children']);
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
