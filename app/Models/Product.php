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
     * Quan hệ với bảng danh mục(nhiều - nhiều)
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
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
        // Update field status
        if($options['field'] == 'status') {
            self::where('id', $params['id'])->update(['status' => $params['status']]);
        }
        // Lưu phần tử mới
        if($options['field'] == 'add-item') {
            $images = $request->images;
            $imageStr = [];
            if($request->hasFile('images')) {
                foreach($images as $key => $image) {
                    $imgName = time() . $key . $image->getClientOriginalName();
                    $image->move("images/{$this->folderImg}", $imgName);
                    $imageStr[] = $imgName;
                }
            }
            $params['thumbnail'] = $imageStr[0];
            $params['images'] = json_encode($imageStr);
            // $this->create($params);
            $product = new Product([
                'title' => $params['title'],
                'description'   => $params['description'],
                'content'       => $params['content'],
                'price'         => $params['price'],
                'quantity'      => $params['quantity'],
                'thumbnail'     => $params['thumbnail'],
                'images'        => $params['images'],
                'status'        => $params['status'],
            ]);
            foreach($request->categories as $key => $category) {
                $product->categories()->attach(Category::find($category));
            }
            $product->save();
        }
        // Update phần tử
        if($options['field'] == 'update-item') {
            if(isset($request->imagesRemove)) {
                $imagesRemove = $request->imagesRemove;
                if(count($imagesRemove) > 0) {
                    foreach($imagesRemove as $image) {
                        $imgPath = "images/{$this->folderImg}/{$image}";
                        unlink($imgPath);
                    }
                }
            }
            $images = $request->images;
            $imageStr = [];
            if($request->hasFile('images')) {
                foreach($images as $key => $image) {
                    $imgName = time() . $key . $image->getClientOriginalName();
                    $image->move("images/{$this->folderImg}", $imgName);
                    $imageStr[] = $imgName;
                }
            }
            self::where('id', $params['id'])->update([
                'title'         => $params['title'],
                'description'   => $params['description'],
                'content'       => $params['content'],
                'price'         => $params['price'],
                'quantity'      => $params['quantity'],
                'thumbnail'     => $imageStr[0],
                'images'        => json_encode($imageStr),
                'status'        => $params['status'],
                'updated_by'    => $params['updated_by']
            ]);
            $product = self::find($params['id'])->categories()->attach($params['categories']);
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
    
    /**
     * Lấy danh mục của sản phẩm
     * @param $id, $fields
     * @return 
     */
    public function getCategoryOfItem($id, $fields) {
        $result = self::find($id)->categories()->select($fields)->get();
        return $result;
    }
}
