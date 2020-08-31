<?php

namespace Payment\Service;

class CurrencyConverter
{	
	const ISO_EURO   = 'EUR';
	const ISO_GBP    = 'GBP';
	const ISO_DOLLAR = 'USD';

	private $currencies;
	private $changes;

    public function __construct()
    {
		$this->currencies = array(
			self::ISO_EURO   => "€",
			self::ISO_GBP    => "£",
			self::ISO_DOLLAR => "$"
		);

		$this->changes = array(
			self::ISO_EURO   => 1,
			self::ISO_GBP    => 1.12,
			self::ISO_DOLLAR => 0.84
		);
    }

	public function convert(string $amount, $currency = self::ISO_EURO) : string
	{
		$amountCurrency = $this->getAmountCurrency($amount);
		if (!empty($amountCurrency)) {
			$amountValue = $this->getAmountValue($amount, $this->currencies[$amountCurrency]);
			return number_format(
				round($this->changes[$amountCurrency] * $amountValue, 2),
				2
			);
		}

		throw new \Exception("Error: amount ".$amount." has't a supported currency");
		
	}

	private function getAmountCurrency(string $amount) : string
	{
		foreach ($this->currencies as $iso => $symbol) {
			$pos = strpos($amount, $symbol);
			if ($pos !== false) {
				return $iso;
			}
		}
	}

	private function getAmountValue(string $amount, string $currency) : string
	{
		$value = str_replace($currency, '', $amount);
		return floatval($value);
	}

}