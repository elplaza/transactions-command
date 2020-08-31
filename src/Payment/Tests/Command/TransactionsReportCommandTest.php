<?php

namespace Payment\Tests\Command;

use Symfony\Component\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Payment\Command\TransactionsReportCommand;

class TransactionsReportCommandTest extends TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new TransactionsReportCommand());

        $command = $application->find('transactions:report');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['customer_id' => 1]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('TXN 1, DATE: 04-01-2015, AMOUNT: £50.00 (which is equivalent to €56.00)', $output);
        $this->assertStringContainsString('TXN 5, DATE: 04-02-2015, AMOUNT: £11.04 (which is equivalent to €12.36)', $output);
        $this->assertStringContainsString('TXN 6, DATE: 04-02-2015, AMOUNT: €1.00 (which is equivalent to €1.00)', $output);
        $this->assertStringContainsString('TXN 7, DATE: 04-03-2015, AMOUNT: $23.05 (which is equivalent to €19.36)', $output);

        $commandTester->execute(['customer_id' => 2]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('TXN 2, DATE: 04-01-2015, AMOUNT: $66.10 (which is equivalent to €55.52)', $output);
        $this->assertStringContainsString('TXN 3, DATE: 04-02-2015, AMOUNT: €12.00 (which is equivalent to €12.00)', $output);
        $this->assertStringContainsString('TXN 4, DATE: 04-02-2015, AMOUNT: £6.50 (which is equivalent to €7.28)', $output);
        $this->assertStringContainsString('TXN 8, DATE: 04-04-2015, AMOUNT: €6.50 (which is equivalent to €6.50)', $output);

        $commandTester->execute(['customer_id' => 3]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Customer 3 has 0 transactions!', $output);
    }
}