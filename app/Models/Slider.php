<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = ['title', 'description', 'content', 'link', 'thumbnail', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $columns = ['id', 'title', 'description', 'content', 'thumbnail', 'link', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
    protected $folderImg = 'slider';

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
                'link'          => $params['link'],
                'thumbnail'     => $params['thumbnail'],
                'status'        => $params['status'],
                'updated_by'    => $params['updated_by']
            ]);
        }
    }

    public function deleteItem($params, $options) {
        if($options['task'] == 'item') {
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItemById($params) {
        return self::select($this->columns)->where('id', $params['id'])->first();
    }
}
