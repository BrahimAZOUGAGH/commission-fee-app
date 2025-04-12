<?php

namespace App\Service;

use App\Entity\Operation;

class OperationProcessor
{
    protected CommissionCalculator $calculator;

    public function __construct()
    {
        $this->calculator = new CommissionCalculator();
    }

    public function processFile(string $file): array
    {
        $handle = fopen($file, 'r');
        $results = [];

        while (($data = fgetcsv($handle)) !== false) {
            $operation = new Operation(...$data);
            $fee = $this->calculator->calculate($operation);
            $results[] = $fee;
        }

        fclose($handle);

        return $results;
    }
}
