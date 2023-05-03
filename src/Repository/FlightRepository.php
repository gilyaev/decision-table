<?php

namespace App\Repository;

use App\Contract\FlightRepositoryInterface;
use App\Exception\DataFileNotFoundException;
use App\ValueObject\FlightInformation;

class FlightRepository implements FlightRepositoryInterface
{
    private string $filePath;

    /**
     * @param string $filePath
     * @throws DataFileNotFoundException
     */
    public function __construct(string $filePath)
    {

        if (!file_exists($filePath)) {
            throw new DataFileNotFoundException($filePath);
        }

        $this->filePath = $filePath;
    }

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        $flights = [];

        if (($handle = fopen($this->filePath, 'rb')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $flights[] = FlightInformation::fromArray([
                    'countryCode' => $row[0],
                    'status' => $row[1],
                    'statusDetail' => (int)$row[2]
                ]);
            }

            fclose($handle);
        }

        return $flights;
    }
}