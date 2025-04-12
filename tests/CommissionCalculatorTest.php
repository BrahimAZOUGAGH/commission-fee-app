<?php

namespace App\Tests;

use App\Entity\Operation;
use App\Service\CommissionCalculator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class CommissionCalculatorTest extends TestCase
{
    public function testDeposit(): void
    {
        $op = new Operation('2024-01-01', '1', 'private', 'deposit', '1000.00', 'EUR');
        $calculator = new CommissionCalculator();
        self::assertSame('0.30', $calculator->calculate($op));
    }
}
