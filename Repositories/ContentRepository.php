<?php

namespace App\Repositories;

use App\Models\Content;
use InfyOm\Generator\Common\BaseRepository;

class ContentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category',
        'description',
        'price',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Content::class;
    }
}
