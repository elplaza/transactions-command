<?php

namespace Payment\Model;

class TransactionRepository extends AbstractRepository
{
    protected function getEntity()
    {
        return Transaction::class;
    }
}
