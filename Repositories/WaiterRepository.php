<?php

namespace App\Repositories;

use App\Models\Waiter;
use InfyOm\Generator\Common\BaseRepository;

class WaiterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'mobilenumber'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Waiter::class;
    }
}
