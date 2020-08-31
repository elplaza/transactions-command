<?php

namespace Payment\Model;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractRepository implements iRepository
{

    private $dataManager;

    private $serializer;

    abstract protected function getEntity();

    /**
     * @var iDataManager $dataManager Class that manage the data
     */
    public function __construct(iDataManager $dataManager)
    {
        $this->dataManager = $dataManager;

        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());

        $this->serializer = new Serializer([
            new DateTimeNormalizer(),
            $normalizer
        ]);
    }

    /**
     * @var array $filters Array with filters
     *
     * @return array
     */
    public function find(array $filters = array())
    {
        $data = $this->dataManager->retrieve($filters);

        $return = array();
        foreach ($data as $value) {
            $return[] = $this->serializer->denormalize(
                $value,
                $this->getEntity(),
                null,
                array(
                    ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true
                )
            );
        }

        return $return;
    }
}
