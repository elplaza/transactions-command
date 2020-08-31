<?php

namespace Payment\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use League\Csv\Reader;
use League\Csv\Statement;

use Payment\Model\Transaction;
use Payment\Model\TransactionRepository;
use Payment\Model\CsvDataManager;
use Payment\Service\CurrencyConverter;


/**
 * Command to report customer payment transactions
 */
class TransactionsReportCommand extends Command
{
    /**
     * Establishes the command configuration
     */
    protected function configure()
    {
        $this
            ->setName('transactions:report')
            ->setDescription('Report customer payment transactions')
            ->addArgument('customer_id', InputArgument::REQUIRED, 'The customer id.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            // Show when the script is launched
            $output->writeln('Start : ' . (new \DateTime())->format('d/m/Y H:i:s') . ' ---');

            // Import CSV on DB via Doctrine ORM
            $dataManager  = (new CsvDataManager())->setFile(Transaction::DATA);
            $rTransaction = new TransactionRepository($dataManager);

            $currencyConverter = new CurrencyConverter();

            $customerId = $input->getArgument('customer_id');

            $txns = $rTransaction->find(array('customer_id' => $customerId));

            $count = count($txns);
            if ($count > 0) {
                $output->writeln('Customer '.$customerId.' has '.count($txns).' transactions:');
            } else {
                $output->writeln('Customer '.$customerId.' has '.count($txns).' transactions!');
            }

            foreach ($txns as $txn) {
                $output->writeln(
                    'TXN '
                    . $txn->getId()
                    . ', '
                    . 'DATE: '
                    . $txn->getDate()->format('d-m-Y')
                    . ', '
                    . 'AMOUNT: '
                    . $txn->getAmount()
                    . ' (which is equivalent to €'
                    . $currencyConverter->convert($txn->getAmount())
                    . ')'
                );
            }

            // Show when the script is over
            $output->writeln('End : ' . (new \DateTime())->format('d-m-Y G:i:s') . ' ---');
            return Command::SUCCESS;
        } catch (\Throwable $t) {
            $output->writeln('Errot : ' . $t->getMessage() . ' ---');
            $output->writeln('End : ' . (new \DateTime())->format('d-m-Y G:i:s') . ' ---');
            return Command::FAILURE;
        }
    }
}