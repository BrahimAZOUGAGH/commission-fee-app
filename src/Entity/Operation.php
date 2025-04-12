<?php

namespace App\Entity;

class Operation
{
    public string $date;
    public int $userId;
    public string $userType;
    public string $operationType;
    public float $amount;
    public string $currency;

    public function __construct(
        string $date,
        string $userId,
        string $userType,
        string $operationType,
        string $amount,
        string $currency
    ) {
        $this->date = $date;
        $this->userId = (int) $userId;
        $this->userType = $userType;
        $this->operationType = $operationType;
        $this->amount = (float) $amount;
        $this->currency = $currency;
    }
}
