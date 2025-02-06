<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 追加
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory; // ← ここを追加
    protected $guarded = ["id"];
    protected $fillable = ["title", "content"];
    public function comments(){
        return $this->hasMany("App\Models\Comment", "post_id");
    }
}
