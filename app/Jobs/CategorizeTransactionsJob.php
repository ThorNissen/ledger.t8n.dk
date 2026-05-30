<?php

namespace App\Jobs;

use App\Services\TransactionCategorizerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CategorizeTransactionsJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public array $backoff = [1, 5, 10];

    public function __construct(public readonly int $userId) {}

    public function handle(TransactionCategorizerService $categorizer): void
    {
        $categorizer->categorizeUncategorized($this->userId);
    }
}
