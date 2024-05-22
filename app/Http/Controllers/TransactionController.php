<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyRequest;
use App\Services\TransactionService;
use App\Services\TransactionServiceInterface;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function __construct(protected TransactionServiceInterface $transactionService)
    {
    }

    public function buy(BuyRequest $request): JsonResponse
    {;
        $result = $this->transactionService->buy($request->all());
        return response()->json($result['message'], $result['status']);
    }
}
