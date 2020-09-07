<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Item extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $guarded = ['user_id', 'status', 'status_cost', 'status_mis', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeGetProdCodes()
    {
        return DB::connection('sqlsrv')->table('prodcode')->select('product_code', 'description')->distinct()->get();
    }
}
