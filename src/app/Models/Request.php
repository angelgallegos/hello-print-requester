<?php

namespace App\Models;

use __\__;

class Request implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $message;

    /**
     * @var string|null
     */
    private ?string $status = null;

    /**
     * @var string|null
     */
    private ?string $token = null;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Request constructor.
     * @param string      $message
     * @param string      $status
     * @param string|null $token
     */
    public function __construct(
        string $message,
        string $status,
        ?string $token
    ) {
        $this->message = $message;
        $this->token = $token;
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param array $data
     * @return Request
     */
    public static function create(array $data): Request
    {
        return new self(
            __::get($data, "message"),
            __::get($data, "status", null),
            __::get($data, "token", null)
        );
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "message" => $this->getMessage(),
            "token" => $this->getToken(),
            "status" => $this->getStatus()
        ];
    }
}