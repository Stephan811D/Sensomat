<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shaft extends Model
{
    use HasFactory;
    protected $table = 'shafts'; //table name
    protected $fillable = ['shaft_id', 'automat_id', 'product_id', 'measuredShaftLength', 'capacity'];

    public function getShaftState(){
        return ($this->level/$this->capacity)*100;;
    }

    public function automat()
    {
        return $this->belongsTo('App\Models\Automat', 'automat_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}