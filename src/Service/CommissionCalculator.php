<?php

namespace App\Service;

use App\Entity\Operation;

class CommissionCalculator
{
    protected CurrencyConverter $converter;
    protected array $history = [];

    public function __construct()
    {
        $this->converter = new CurrencyConverter();
    }

    public function calculate(Operation $op): string
    {
        $fee = 0.0;

        if ('deposit' === $op->operationType) {
            $fee = $op->amount * 0.0003;
        } elseif ('withdraw' === $op->operationType) {
            if ('business' === $op->userType) {
                $fee = $op->amount * 0.005;
            } elseif ('private' === $op->userType) {
                $fee = $this->calculatePrivateWithdraw($op);
            }
        }

        return $this->roundUp($fee, $op->currency);
    }

    protected function calculatePrivateWithdraw(Operation $op): float
    {
        $week = date('o-W', strtotime($op->date));
        $key = "{$op->userId}-{$week}";
        if (!isset($this->history[$key])) {
            $this->history[$key] = ['count' => 0, 'total' => 0.0];
        }

        ++$this->history[$key]['count'];
        $converted = 'EUR' !== $op->currency ? $this->converter->convertToEUR($op->amount, $op->currency) : $op->amount;
        $chargeable = 0.0;

        if ($this->history[$key]['count'] <= 3) {
            $left = max(0.0, 1000.0 - $this->history[$key]['total']);
            if ($converted > $left) {
                $chargeable = $converted - $left;
                $this->history[$key]['total'] = 1000.0;
            } else {
                $this->history[$key]['total'] += $converted;
            }
        } else {
            $chargeable = $converted;
        }

        return 'EUR' !== $op->currency
            ? $this->converter->convertFromEUR($chargeable * 0.003, $op->currency)
            : $chargeable * 0.003;
    }

    protected function roundUp(float $amount, string $currency): string
    {
        $precision = match ($currency) {
            'JPY' => 0,
            'USD', 'EUR' => 2,
            default => 2
        };

        return number_format(ceil($amount * 10 ** $precision) / 10 ** $precision, $precision, '.', '');
    }
}
