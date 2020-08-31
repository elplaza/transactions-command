<?php

namespace Payment\Model;

class Transaction
{
	/**
	 * @var mixed $id Identifier
	 */
	private $id;

	/**
	 * @var int $customerId Related customer identifier
	 */
	private $customerId;

	/**
	 * @var Customer $customer Related customer object
	 */
	private $customer;

	/**
	 * @var DateTime $date Creation date
	 */
	private $date;

	/**
	 * @var string $amount Amount
	 */
	private $amount;

	/**
	 * @var float $value Amount value
	 */
	private $value;

	/**
	 * @var string $currency Amount currency
	 */
	private $currency;

    const DATA = '/app/data/transactions.csv';

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Transaction
     */
    public function setId($id) : Transaction
    {
        $this->id = intval($id);

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     *
     * @return Transaction
     */
    public function setCustomerId(int $customerId) : Transaction
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer() : Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return Transaction
     */
    public function setCustomer(Customer $customer) : Transaction
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate() : \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Transaction
     */
    public function setDate(\DateTime $date) : Transaction
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getAmount() : string
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     *
     * @return Transaction
     */
    public function setAmount($amount) : Transaction
    {
        $this->amount = $amount;

        // @TODO: set value and currency
        
        return $this;
    }

    /**
     * @return float
     */
    public function getValue() : float
    {
        return $this->value;
    }

    /**
     * @param float $value
     *
     * @return Transaction
     */
    public function setValue(float $value) : Transaction
    {
        $this->value = $value;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return Transaction
     */
    public function setCurrency(string $currency) : Transaction
    {
        $this->currency = $currency;
        
        return $this;
    }
}
