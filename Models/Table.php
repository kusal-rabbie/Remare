<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Table
 * @package App\Models
 * @version May 10, 2017, 5:38 pm UTC
 */
class Table extends Model
{
    use SoftDeletes;

    public $table = 'tables';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'capacity',
        'availability'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'capacity' => 'string',
        'availability' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'capacity' => 'required',
        'availability' => 'required'
    ];

    
}
