<?php

namespace Payment\Model;

use League\Csv\Reader;
use League\Csv\Statement;

class CsvDataManager implements iDataManager
{
	private $file;

    public function retrieve(array $filters = array()): \Traversable
    {
    	$file = $this->getFile();
    	if (empty($file)) {
    		throw new \Exception("Error: file is required");
    	}

        if (!file_exists($file)) {
    		throw new \Exception("Error: file does not exists");
        }

        //load the CSV document from a stream
        $csv = $this->getReader();

        //build a statement
        $stmt = new Statement();

        foreach ($filters as $key => $value) {
	        $stmt = $stmt->where(
	        	function ($row) use ($key, $value) {
		            if (isset($row[$key]) && $row[$key] == $value) {
		            	return $row;
		            }
	        	}
	        );
        }

        //query your records from the document
        return $stmt->process($csv);
    }

    protected function getReader()
    {
        $stream = fopen($this->getFile(), 'r');
        $csv = Reader::createFromStream($stream);
        $csv
            ->setDelimiter(';')
            ->setHeaderOffset(0)
        ;

        return $csv;
    }

    /**
     * @return string
     */
    public function getFile() : string
    {
        return $this->file;
    }

    /**
     * @param string $file
     *
     * @return CsvDataManager
     */
    public function setFile(string $file) : CsvDataManager
    {
        $this->file = $file;

        return $this;
    }
}
