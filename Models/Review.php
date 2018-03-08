<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Review
 * @package App\Models
 * @version May 15, 2017, 7:04 pm UTC
 */
class Review extends Model
{
    use SoftDeletes;

    public $table = 'reviews';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'reservation_id',
        'customer_id',
        'rating',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'reservation_id' => 'required',
        'customer_id' => 'required',
        'rating' => 'required',
        'description' => 'required'
    ];

    
}
