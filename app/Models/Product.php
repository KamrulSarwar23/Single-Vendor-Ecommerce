<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function vendor(){

        return $this->belongsTo(Vendor::class);
    }
    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function subcategory(){

        return $this->belongsTo(SubCategory::class, 'category_id', 'id');
    }

    public function childcategory(){

        return $this->belongsTo(ChildCategory::class, 'category_id', 'id');
    }
    
    public function productImageGallery(){

        return $this->hasMany(ProductImageGallery::class);
    }

    public function variant(){

        return $this->hasMany(ProductVariant::class);
    }


    public function brand(){

        return $this->belongsTo(Brand::class);
    }
}
