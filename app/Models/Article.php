<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * $table: tên bảng tham chiếu
     * $fillable: các field được cập nhật
     * $columns: các field được lựa chọn lấy thông tin
     * $folderImg: đường dẫn chứa ảnh
     */
    protected $table = 'articles';
    protected $fillable = ['title', 'category_id', 'description', 'content', 'is_hot', 'is_feature', 'thumbnail', 'status', 'author', 'pseudonym', 'source', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $columns = ['id', 'title', 'category_id', 'description', 'content', 'is_hot', 'is_feature', 'thumbnail', 'status', 'author', 'pseudonym', 'source', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $folderImg = 'article';


    /**
     * Quan hệ với bảng danh mục(nhiều - nhiều)
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
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
            if($request->hasFile('thumbnail')) {
                $imgName = time() . $params['thumbnail']->getClientOriginalName();
                $params['thumbnail']->move("images/{$this->folderImg}", $imgName);
                $params['thumbnail'] = $imgName;
            }
            $this->create($params);
        }
        // Update phần tử
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
                'category_id'   => $params['category_id'],
                'thumbnail'     => $params['thumbnail'],
                'status'        => $params['status'],
                'updated_by'    => $params['updated_by'],
                'author'        => $params['author'],
                'pseudonym'     => $params['pseudonym'],
                'source'        => $params['source'],
                'is_hot'        => $params['is_hot'],
                'is_feature'    => $params['is_feature']
            ]);
            $article = self::find($params['id']);
            return $article;
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
}
