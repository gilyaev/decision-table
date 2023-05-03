<?php

namespace App\ValueObject;

use InvalidArgumentException;

final class FlightInformation
{
    public const STATUS_CANCEL = 'Cancel';
    public const STATUS_DELAY = 'Delay';

    public const AVAILABLE_STATUS = [
        self::STATUS_CANCEL,
        self::STATUS_DELAY,
    ];

    private string $countryCode;
    private string $status;
    private int $statusDetail;

    /**
     * @param string $countryCode
     * @param string $status
     * @param int $statusDetail
     */
    private function __construct(
        string $countryCode,
        string $status,
        int $statusDetail
    ) {
        $this->countryCode = $countryCode;
        $this->status = $status;
        $this->statusDetail = $statusDetail;
    }

    public static function fromArray(array $data): self
    {
        if (!in_array($data['status'] ?? null, self::AVAILABLE_STATUS, true)) {
            throw new InvalidArgumentException(
                'The status must be specified and should contain one of the following values: ' . implode(', ', self::AVAILABLE_STATUS)
            );
        }

        if (empty($data['countryCode']) || strlen($data['countryCode']) !== 2) {
            throw new InvalidArgumentException(
                'The country code must be specified and should be a string with a length of 2 characters'
            );
        }

        if (empty($data['statusDetail']) || !is_int($data['statusDetail'])) {
            throw new InvalidArgumentException(
                'The status details must be specified and should be an integer'
            );
        }

        return new self(
            $data['countryCode'],
            $data['status'],
            $data['statusDetail']
        );
    }

    public function toArray(): array
    {
        return [
            'countryCode' => $this->getCountryCode(),
            'status' => $this->getStatus(),
            'statusDetail' => $this->getStatusDetail(),
        ];
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function isCancel(): bool
    {
        return  $this->status === self::STATUS_CANCEL;
    }

    public function isDelay(): bool
    {
        return  $this->status === self::STATUS_DELAY;
    }

    /**
     * @return int
     */
    public function getStatusDetail(): int
    {
        return $this->statusDetail;
    }
}