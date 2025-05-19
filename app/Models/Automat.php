<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class Automat extends Model
{
    use HasFactory;
    protected $table = 'automats'; //table name
    protected $fillable = ['automatId', 'automatName', 'addressLine1', 'addressLine2', 'zipCode', 'city', 'region', 'country'];

    public function getCurrentState()
    {
        $currentState = 0;
        $level = DB::table('shafts')->where('automat_id', '=', $this->id)->sum('level');
        $capacity = DB::table('shafts')->where('automat_id', '=', $this->id)->sum('capacity');

        if($capacity != 0)
        {
            $currentState = round($level / $capacity * 100);
        }
        
        return $currentState;
    }

    public function getOnlineStatus()
    {
        $timeDifference = Carbon::now()->addHour()->diffInMinutes($this->updated_at);
        if ($timeDifference >= 10) {
            return false;
        } else {
            return true;
        }
    }

    public function getLastAccess()
    {
        return Carbon::now()->addHour()->diffForHumans($this->updated_at, true);
    }

    public function getLastDoorState()
    {
        return Carbon::now()->addHour()->diffForHumans($this->lastDoorState, true);
    }

    public function shaft()
    {
        return $this->hasMany('App\Models\Shaft', 'automat_id', 'id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'shafts', 'automat_id', 'product_id');
    }
}
