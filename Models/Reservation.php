<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reservation
 * @package App\Models
 * @version May 15, 2017, 12:07 pm UTC
 */
class Reservation extends Model
{
    use SoftDeletes;

    public $table = 'reservations';
    
    protected $dateformat = 'Y-m-d';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_id',
        'waiter_id',
        'table_id',
        'date',
        'time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_id' => 'integer',
        'waiter_id' => 'integer',
        'table_id' => 'integer',
        'date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_id' => 'required',
        'waiter_id' => 'nullable',
        'table_id' => 'nullable',
        'date' => 'required|after:today',
        'time' => 'required'
    ];

    public function table(){

        return $this->BelongsTo('App\Models\Table');

    }

    public function waiter(){

        return $this->BelongsTo('App\Models\Waiter');

    }

    
}
