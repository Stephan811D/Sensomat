<?php

namespace App\Models;

use App\Models\Shaft;
use App\Models\Automat;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['productName', 'productType_id', 'price', 'color'];

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType', 'productType_id', 'id');
    }
    public function shaft()
    {
        return $this->hasMany('App\Models\Shaft', 'product_id', 'id');
    }
    public function automat(){
        return $this->belongsToMany('App\Models\Automat', 'shafts', 'product_id', 'automat_id');
    }
}
