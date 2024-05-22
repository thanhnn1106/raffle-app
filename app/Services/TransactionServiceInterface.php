<?php

namespace App\Services;

/**
 * Interface TransactionServiceInterface
 */
interface TransactionServiceInterface
{
    public function buy(array $requestParams): array;
}
