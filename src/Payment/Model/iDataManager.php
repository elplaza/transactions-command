<?php

namespace Payment\Model;

use Iterator;

interface iDataManager
{
    public function retrieve(array $filters = array()): \Traversable;
}
