<?php

namespace Payment\Model;

class Customer
{
	/**
	 * @var int $id Identifier
	 */
	private $id;

	/**
	 * @var Transaction[] $transactions Customer transactions
	 */
	private $transactions;

    const DATA = '/app/data/customers.csv';

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Customer
     */
    public function setId(int $id) : Customer
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param Transaction $transaction
     *
     * @return Customer
     */
    public function addTransaction(Transaction $transaction) : Customer
    {
        $this->transactions[] = $transaction;

        return $this;
    }
}
