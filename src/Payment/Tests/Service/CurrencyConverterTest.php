<?php

namespace Payment\Tests\Service;

use Symfony\Component\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Payment\Model\CsvDataManager;
use Payment\Model\TransactionRepository;
use Payment\Model\Transaction;
use Payment\Service\CurrencyConverter;

class CurrencyConverterTest extends TestCase
{
    public function testConvert()
    {
        $converter = new CurrencyConverter();

        $this->assertEquals("€56.00", "€".$converter->convert("£50.00"));
        $this->assertEquals("€12.36", "€".$converter->convert("£11.04"));
        $this->assertEquals("€1.00", "€".$converter->convert("€1.00"));
        $this->assertEquals("€19.36", "€".$converter->convert("$23.05"));
    }
}