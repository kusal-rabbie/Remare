<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Offer
 * @package App\Models
 * @version May 10, 2017, 5:31 pm UTC
 */
class Offer extends Model
{
    use SoftDeletes;

    public $table = 'offers';
    

    protected $dates = ['deleted_at'];
//    protected $description;


    public $fillable = [
        'content_category',
        'content_name',
        'description',
        'start_date',
        'end_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content_category' => 'string',
        'content_name' => 'string',
        'description' => 'string',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'content_category' => 'required',
        'content_name' => 'required',
        'description' => 'required',
        'start_date' => 'after:tomorrow',
        'end_date' => 'after:start_date'
    ];

    public function content(){

        return $this->hasMany('App\Content');
    }

//    public function description(){
//
//        return $this->description;
//    }

    
}
