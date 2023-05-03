<?php

namespace App\Exception;

use Exception;

class DataFileNotFoundException extends Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("The data file '$filePath' does not exist.");
    }
}
