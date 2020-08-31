<?php

namespace Payment\Tests\Model;

use Symfony\Component\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Payment\Model\CsvDataManager;
use Payment\Model\TransactionRepository;
use Payment\Model\Transaction;

class TransactionRepositoryTest extends TestCase
{
    public function testFind()
    {
        $dataManager  = (new CsvDataManager())->setFile(Transaction::DATA);
        $rTransaction = new TransactionRepository($dataManager);

        $txns = $rTransaction->find(
            array('customer_id' => 3)
        );

        $this->assertCount(0, $txns);

        $txns = $rTransaction->find(
            array('customer_id' => 1)
        );
        
        $this->assertCount(4, $txns);

        $txn = (new Transaction())
            ->setId(1)
            ->setCustomerId(1)
            ->setDate(new \DateTime("01/04/2015"))
            ->setAmount("£50.00")
        ;

        $this->assertEquals($txn, $txns[0]);

        $txn = (new Transaction())
            ->setId(5)
            ->setCustomerId(1)
            ->setDate(new \DateTime("02/04/2015"))
            ->setAmount("£11.04")
        ;

        $this->assertEquals($txn, $txns[1]);

        $txn = (new Transaction())
            ->setId(6)
            ->setCustomerId(1)
            ->setDate(new \DateTime("02/04/2015"))
            ->setAmount("€1.00")
        ;

        $this->assertEquals($txn, $txns[2]);

        $txn = (new Transaction())
            ->setId(7)
            ->setCustomerId(1)
            ->setDate(new \DateTime("03/04/2015"))
            ->setAmount("$23.05")
        ;

        $this->assertEquals($txn, $txns[3]);
    }
}