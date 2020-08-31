<?php

namespace Payment\Model;

interface iRepository
{
    public function find(array $filters = array());
}
