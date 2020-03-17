<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * $table: tên bảng tham chiếu
     * $fillable: các field được cập nhật
     * $columns: các field được lựa chọn lấy thông tin
     * $folderImg: đường dẫn chứa ảnh
     */
    protected $table = 'products';
    protected $fillable = ['title', 'description', 'content', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'price', 'sale_up', 'quantity', 'is_hot', 'is_bestseller', 'thumbnail', 'images'];
    protected $columns = ['id', 'title', 'description', 'content', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'price', 'sale_up', 'quantity', 'is_hot', 'is_bestseller', 'thumbnail', 'images'];
    protected $folderImg = 'product';

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
            $images = $request->images;
            $imageStr = [];
            foreach($images as $key => $image) {
                $imgName = time() . $key . $image->getClientOriginalName();
                $image->move("images/{$this->folderImg}", $imgName);
                $imageStr[] = $imgName;
            }
            $params['thumbnail'] = $imageStr[0];
            $params['images'] = json_encode($imageStr);
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
                'link'          => $params['link'],
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
    public function getItemById($params) {
        return self::select($this->columns)->where('id', $params['id'])->first();
    }
}
