<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "author",
        "post_foto",
        "deskripsi",
        "category_id"
    ];

    public function scopeFind_news($query, array $fileters){

        $query->when($fileters["category"] ?? false, function($query, $category){
            return $query->whereHas("category", function($query) use ($category){
                $query->where("category",  $category);
            });
        });

        $query->when($fileters["search"] ?? false, function($query, $search){
            return $query->where("title", "like", "%" . $search . "%")
                    ->orwhere("deskripsi", "like", "%" . $search);
        });

    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
