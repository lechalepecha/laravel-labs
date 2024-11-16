<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'description', 'content', 'category_id', 'thumbnail'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function tags(){

        return $this->belongsToMany(Tag::class)->withTimestamps();

    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public static function imageUpload(Request $request, $image = null)
    {
        if($request->hasFile('thumbnail'))
        {
            if($_COOKIE)
            {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if(!$this->thumbnail)
        {
            return asset("no_image.jpg");
        }
        return asset("uploads/{$this->thumbnail}");
    }
}
