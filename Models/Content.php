<?php

namespace App\Models;

use Eloquent as Model;
use App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Content
 * @package App\Models
 * @version May 10, 2017, 4:59 pm UTC
 */
class Content extends Model
{
    use SoftDeletes;

    public $table = 'contents';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'category',
        'description',
        'price',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'category' => 'string',
        'description' => 'string',
        'price' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:contents|max:255',
        'category' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'url|unique:contents,image|nullable'
    ];

    public function offers(){

        return $this->hasMany(App\Models\Offer);
    }

    
}
