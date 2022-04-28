<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['title','slug','post_category_id','author', 'image','body'];

    //relation many to one table database
    public function postCategory (){
        return $this->belongsTo(PostCategory::class);
    }
}
