<?php

namespace App\Repositories;

use App\Models\Offer;
use InfyOm\Generator\Common\BaseRepository;

class OfferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content_category',
        'content_name',
        'description',
        'start_date',
        'end_date'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Offer::class;
    }
}
