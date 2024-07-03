<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    public function category(){

        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCreatedAtAttribute($value) {
         
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }
}
