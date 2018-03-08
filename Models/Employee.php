<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 * @package App\Models
 * @version May 11, 2017, 8:19 am UTC
 */
class Employee extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'authentication',
        'image',
        'mobilenumber',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'authentication' => 'string',
        'image' => 'string',
        'mobilenumber' => 'integer',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|max:255|alpha',
        'last_name' => 'required|max:255|alpha',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'mobilenumber' => 'required|size:10',
        'image' => 'unique:users,image|nullable|url'
    ];

    public function reservations(){
        if(Auth::user()->authentication == 'customer'){

            return $this->hasMany(App\Models\Reservation);
        }
        else{
            return null;
        }

    }

    
}
