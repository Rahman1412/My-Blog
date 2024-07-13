<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogMetadata;

class Blogs extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','short_desc'];
    

    function meta(){
        return $this->hasOne(BlogMetadata::class,'blog_id');
    }
}
