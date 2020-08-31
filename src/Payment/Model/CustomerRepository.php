<?php

namespace Payment\Model;

class CustomerRepository extends AbstractRepository
{
    protected function getEntity()
    {
        return Customer::class;
    }
}
