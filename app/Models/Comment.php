<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 追加
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory; // ← ここを追加
    protected $guarded = ["id"];
    protected $fillable = ["body", "post_id"];
    public function post(){
        return $this->belongsTo("App\Models\Post");
    }
}
