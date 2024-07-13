<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogMetadata extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id'];

    public function Blog()
    {
        return $this->belongsTo(Blogs::class);
    }
}
