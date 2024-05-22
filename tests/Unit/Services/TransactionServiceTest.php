<?php

namespace Tests\Unit\Services;

use App\Models\Entry;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Eloquent\EntryRepository;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\TransactionService;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;
use Mockery as m;

class TransactionServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public static function buyDataProvider(): array
    {
        return [
            'no user found.' => [
                'params' => [
                    'email' => 'puppy@betterworld.org',
                    'amount' => 10,
                    'userRepositoryResult' => null,
                    'transactionRepositoryResult' => null,
                    'entryRepositoryResult' => null,
                ],
                'expected' => [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => 'User not found.' // There is a way to use __() here but haven't figure it out yet with Laravel 11,
                ],
            ],
            'transaction failed to create.' => [
                'params' => [
                    'email' => 'puppy@betterworld.org',
                    'amount' => 10,
                    'userRepositoryResult' => new User([
                        'id' => 1,
                        'puppy@betterworld.org' => 1,
                    ]),
                    'transactionRepositoryResult' => false,
                    'entryRepositoryResult' => null,
                ],
                'expected' => [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Transaction failed to create. Please try again later.' // There is a way to use __() here but haven't figure it out yet with Laravel 11,
                ],
            ],
            'entry failed to create.' => [
                'params' => [
                    'email' => 'puppy@betterworld.org',
                    'amount' => 10,
                    'userRepositoryResult' => new User([
                        'id' => 1,
                        'puppy@betterworld.org' => 1,
                    ]),
                    'transactionRepositoryResult' => new Transaction(
                        [
                            'id' => 1,
                            'user_id' => 1,
                            'amount' => 10,
                        ]
                    ),
                    'entryRepositoryResult' => null,
                ],
                'expected' => [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Entry failed to create. Please try again later.' // There is a way to use __() here but haven't figure it out yet with Laravel 11,
                ],
            ],
            'transaction created successfully' => [
                'params' => [
                    'email' => 'puppy@betterworld.org',
                    'amount' => 10,
                    'userRepositoryResult' => new User([
                        'id' => 1,
                        'puppy@betterworld.org' => 1,
                    ]),
                    'transactionRepositoryResult' => new Transaction(
                        [
                            'id' => 1,
                            'user_id' => 1,
                            'amount' => 10,
                        ]
                    ),
                    'entryRepositoryResult' => new Entry([
                        'transaction_id' => 1,
                        'user_id' => 1,
                        'entries' => 10,
                    ]),
                ],
                'expected' => [
                    'status' => Response::HTTP_CREATED,
                    'message' => 'Transaction created successfully. You have 10 entries. Thank you.' // There is a way to use __() here but haven't figure it out yet with Laravel 11,
                ],
            ],
        ];
    }

    #[DataProvider('buyDataProvider')]
    public function testBuy($params, $expected): void
    {
        $userRepository = m::mock(UserRepositoryInterface::class);
        $userRepository->shouldReceive('findOneBy')
            ->andReturn($params['userRepositoryResult']);

        $transactionRepository = m::mock(TransactionRepositoryInterface::class);
        $transactionRepository->shouldReceive('create')
            ->andReturn($params['transactionRepositoryResult']);

        $entryRepository = m::mock(EntryRepository::class);
        $entryRepository->shouldReceive('create')
            ->andReturn($params['entryRepositoryResult']);

        $transactionService = new TransactionService(
            $userRepository,
            $transactionRepository,
            $entryRepository
        );

        $this->assertSame($expected, $transactionService->buy($params));
    }
}
