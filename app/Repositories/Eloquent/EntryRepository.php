<?php

namespace App\Repositories\Eloquent;

use App\Models\Entry;
use App\Repositories\EntryRepositoryInterface;

class EntryRepository extends BaseRepository implements EntryRepositoryInterface
{
    /**
     * EntryRepository constructor.
     */
    public function __construct(protected Entry $model)
    {
        parent::__construct($this->model);
    }
}
