<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'productTypes';
    protected $fillable = ['productType', 'productDepth'];
    
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'productType_id', 'id');
    }
}
