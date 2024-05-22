<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\TransactionRepositoryInterface;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    /**
     * TransactionRepository constructor.
     */
    public function __construct(protected Transaction $model)
    {
        parent::__construct($this->model);
    }
}
