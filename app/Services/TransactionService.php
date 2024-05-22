<?php

namespace App\Services;

use App\Models\Entry;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\EntryRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Response;

class TransactionService implements TransactionServiceInterface
{
    /**
     * TransactionService constructor.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected TransactionRepositoryInterface $transactionRepository,
        protected EntryRepositoryInterface $entryRepository
    ) {
    }

    public function buy(array $requestParams): array
    {
        $user = $this->userRepository->findOneBy(User::FIELD_EMAIL, $requestParams['email']);

        if (!$user) {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => __('text.user_not_found')
            ];
        }

        $entries = $this->calEntryByTransactionAmount($requestParams['amount']);

        // Todo
        // This one should be implemented with DB Transaction (Commit/Rollback)
        // If is there any error within this request, the DB transactions should be rollback
        // The best practice is we will create a DB Transaction middleware
        // And attach this middleware to any route have multiple DB transactions like this

        $isTransactionCreated = $this->transactionRepository->create([
            Transaction::FIELD_USER_ID => $user->id,
            Transaction::FIELD_AMOUNT => $requestParams['amount'],
        ]);

        if (!$isTransactionCreated) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => __('text.transaction_failed_to_create')
            ];
        }

        $isEntryGiven = $this->entryRepository->create(
            [
                Entry::FIELD_TRANSACTION_ID => $isTransactionCreated->id,
                Entry::FIELD_USER_ID => $user->id,
                Entry::FIELD_ENTRIES => $entries,
            ]
        );

        if (!$isEntryGiven) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => __('text.entry_failed_to_create')
            ];
        }

        return [
            'status' => Response::HTTP_CREATED,
            'message' => __('text.transaction_created_successfully', ['entries' => $entries]),
        ];
    }

    private function calEntryByTransactionAmount(float $amount): int
    {
        // I assumed 1 entry is equal to 1 dollar
        return (int)($amount / 1);
    }
}
