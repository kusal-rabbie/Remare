<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Waiter
 * @package App\Models
 * @version May 10, 2017, 5:01 pm UTC
 */
class Waiter extends Model
{
    use SoftDeletes;

    public $table = 'waiters';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'mobilenumber'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'mobilenumber' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'mobilenumber' => 'required|size:10'
    ];

    function reservations(){

        return $this->hasMany('App\Models\Reservation');
    }

    
}
