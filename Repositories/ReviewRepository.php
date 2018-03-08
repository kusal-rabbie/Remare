<?php

namespace App\Repositories;

use App\Models\Review;
use InfyOm\Generator\Common\BaseRepository;

class ReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reservation_id',
        'customer_id',
        'rating',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Review::class;
    }
}
