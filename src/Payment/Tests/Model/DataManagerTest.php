<?php

namespace Payment\Tests\Model;

use Symfony\Component\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Payment\Model\CsvDataManager;
use Payment\Model\Transaction;

class DataManagerTest extends TestCase
{
    public function testRetrieve()
    {
        $csvDataManager = new CsvDataManager();

        $this->assertTrue(
            method_exists($csvDataManager, 'setFile'),
            "CsvDataManager has't method setFile"

        );

        $csvDataManager->setFile(Transaction::DATA);

        // all transactions
        $items = $csvDataManager->retrieve();
        $this->assertCount(8, $items);

        // filter by customer_id
        $items = $csvDataManager->retrieve(
            array('customer_id' => 1)
        );
        $this->assertCount(4, $items);

        $items = $csvDataManager->retrieve(
            array('customer_id' => 2)
        );
        $this->assertCount(4, $items);

        $items = $csvDataManager->retrieve(
            array('customer_id' => 3)
        );
        $this->assertCount(0, $items);

        // filter by date
        $items = $csvDataManager->retrieve(
            array('date' => '01/04/2015')
        );
        $this->assertCount(2, $items);

        $items = $csvDataManager->retrieve(
            array('date' => '02/04/2015')
        );
        $this->assertCount(4, $items);

        $items = $csvDataManager->retrieve(
            array('date' => '03/04/2015')
        );
        $this->assertCount(1, $items);

        $items = $csvDataManager->retrieve(
            array('date' => '04/04/2015')
        );
        $this->assertCount(1, $items);

        $items = $csvDataManager->retrieve(
            array('date' => '05/04/2015')
        );
        $this->assertCount(0, $items);

        // filter by amount
        $items = $csvDataManager->retrieve(
            array('amount' => '£11.04')
        );
        $this->assertCount(1, $items);

        $items = $csvDataManager->retrieve(
            array('amount' => '$66.10')
        );
        $this->assertCount(1, $items);

        $items = $csvDataManager->retrieve(
            array('amount' => '€12.00')
        );
        $this->assertCount(1, $items);

        $items = $csvDataManager->retrieve(
            array('amount' => '€13.10')
        );
        $this->assertCount(0, $items);

        // test item
        $items = $csvDataManager->retrieve(
            array('amount' => '€12.00')
        );

        $iterator = $items->getIterator();
        $this->assertEquals(
            array(
                "id"          => "3",
                "customer_id" => "2",
                "date"        => "02/04/2015",
                "amount"      => "€12.00"
            ),
            $iterator->current()
        );
    }
}