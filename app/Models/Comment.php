<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'parent_id', 'content'];

    // Автор комментария
    public function user() {
        return $this->belongsTo(User::class);
    }
    // Товар, к которому относится комментарий
    public function product() {
        return $this->belongsTo(Product::class);
    }
    // Ответы на этот комментарий
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    
}