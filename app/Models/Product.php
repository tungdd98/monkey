<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    /**
     * $table: tên bảng tham chiếu
     * $fillable: các field được cập nhật
     * $columns: các field được lựa chọn lấy thông tin
     * $folderImg: đường dẫn chứa ảnh
     */
    protected $table = 'products';
    protected $fillable = ['title', 'code', 'description', 'content', 'thumbnail', 'images', 'price', 'original_price', 'quantity', 'status', 'is_hot', 'is_bestseller',  'unit_id', 'supplier_id', 'created_by', 'updated_by'];
    protected $columns = ['id', 'title', 'code', 'description', 'content', 'thumbnail', 'images', 'price', 'original_price', 'quantity', 'status', 'is_hot', 'is_bestseller',  'unit_id', 'supplier_id', 'created_by', 'updated_by'];
    protected $folderImg = 'product';

    /**
     * Quan hệ với bảng danh mục(nhiều - nhiều)
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    public function bills() {
        return $this->belongsToMany('App\Models\Bill')->withPivot('quantity');
    }

    public function units() {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'id');
    }

    public function suppliers() {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }
    /**
     * Lấy danh sách phần tử
     * 
     * @param $params: thông tin requests
     * @param $options: tên task
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
        if($options['field'] == 'quantity') {
            self::where('id', $params['id'])->update(['quantity' => $params['quantity']]);
        }
        // Lưu phần tử mới
        if($options['field'] == 'add-item') {
            $images = $request->images;
            $imagesStr = [];
            if($request->hasFile('images')) {
                foreach($images as $key => $image) {
                    $imgName = time() . $key . $image->getClientOriginalName();
                    $image->move("images/{$this->folderImg}", $imgName);
                    $imagesStr[] = $imgName;
                }
            }
            $params['thumbnail'] = $imagesStr[0];
            $params['images'] = json_encode($imagesStr);
            $product = new Product([
                'title'         => $params['title'],
                'code'          => !empty($params['code']) ? $params['code'] : Str::random(5),  
                'description'   => $params['description'],
                'content'       => $params['content'],
                'thumbnail'     => $params['thumbnail'],
                'images'        => $params['images'],
                'price'         => $params['price'],
                'original_price'=> $params['original_price'],
                'quantity'      => $params['quantity'],
                'status'        => $params['status'],
                'is_hot'        => $params['is_hot'],
                'is_bestseller' => $params['is_bestseller'],
                'unit_id'       => $params['unit_id'],
                'supplier_id'   => $params['supplier_id'],
                'created_by'    => $params['created_by']
            ]);
            $product->save();
            foreach($request->categories as $key => $value) {
                $product->categories()->attach($value);
            }
            return $product;
        }
        // Update phần tử
        if($options['field'] == 'update-item') {
            if(!empty($request->imagesRemove)) {
                $imagesRemove = $request->imagesRemove;
                if(count($imagesRemove) > 0) {
                    foreach($imagesRemove as $image) {
                        $imgPath = "images/{$this->folderImg}/{$image}";
                        unlink($imgPath);
                    }
                }
            }
            if(!empty($request->imagesUpdate)) {
                $images = $request->imagesUpdate;
                $imageStr = [];
                if($request->hasFile('imagesUpdate')) {
                    foreach($images as $key => $image) {
                        $imgName = time() . $key . $image->getClientOriginalName();
                        $image->move("images/{$this->folderImg}", $imgName);
                        $imageStr[] = $imgName;
                    }
                }
                foreach($request->images as $key => $value) {
                    $imagesStr[] = $value;
                }
                self::where('id', $params['id'])->update([
                    'thumbnail'     => $imageStr[0],
                    'images'        => json_encode($imageStr),
                ]);
            }
            self::where('id', $params['id'])->update([
                'title'         => $params['title'],
                'code'          => $params['code'],  
                'description'   => $params['description'],
                'content'       => $params['content'],
                'price'         => $params['price'],
                'original_price'=> $params['original_price'],
                'quantity'      => $params['quantity'],
                'status'        => $params['status'],
                'is_hot'        => $params['is_hot'],
                'is_bestseller' => $params['is_bestseller'],
                'unit_id'       => $params['unit_id'],
                'supplier_id'   => $params['supplier_id'],
                'updated_by'    => $params['updated_by']
            ]);
            $product = self::find($params['id']);
            if(!empty($request->categoriesRemove)) {
                foreach($request->categoriesRemove as $key => $value) {
                    $product->categories()->detach($value);
                }
            }
            if(!empty($request->categoriesUpdate)) {
                foreach($request->categoriesUpdate as $key => $value) {
                    $product->categories()->attach($value);
                }
            }
            return $product;
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
        }
    }

    /**
     * Lấy phần tử theo id
     * 
     * @param $params: thông tin requests
     * @return void
     */
    public function getItemById($request) {
        return self::select($this->columns)->where('id', $request->id)->first();
    }
    
    /**
     * Lấy danh mục của sản phẩm
     * 
     * @param $id, $fields
     * @return 
     */
    public function getCategoryOfItem($id, $fields) {
        $result = self::find($id)->categories()->select($fields)->get();
        return $result;
    }

    /**
     * Lấy đơn vị
     * 
     * @param $id, $fields
     * @return 
     */
    public function getUnitOfItem($id, $fields) {
        $result = self::find($id)->units()->select($fields)->get();
        return $result;
    }

    /**
     * Lấy nhà sản xuất
     * 
     * @param $id, $fields
     * @return 
     */
    public function getSupplierOfItem($id, $fields) {
        $result = self::find($id)->suppliers()->select($fields)->get();
        return $result;
    }
}
