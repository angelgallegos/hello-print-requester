<?php

namespace App\Services;

use App\Clients\BrokerClient;
use App\Models\Request;
use Framework\Utils\Configuration\ConfigurationInterface;
use GuzzleHttp\Exception\GuzzleException;
use Monolog\Logger;

class RequestService
{
    /**
     * @var BrokerClient
     */
    private BrokerClient $brokerClient;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @var ConfigurationInterface
     */
    private ConfigurationInterface $config;

    /**
     * RequestService constructor.
     * @param BrokerClient $brokerClient
     * @param Logger $logger
     * @param ConfigurationInterface $configuration
     */
    public function __construct(
        BrokerClient $brokerClient,
        Logger $logger,
        ConfigurationInterface $configuration
    ) {
        $this->brokerClient = $brokerClient;
        $this->config = $configuration;
        $this->logger = $logger;
    }

    /**
     * @return Request|null
     */
    public function createAndSend(): ?Request
    {
        $request = new Request(
            "Hi",
            "created",
            null
        );
        $request = $this->send($request);

        return $request;
    }

    /**
     * @param Request $request
     * @return Request|null
     */
    public function send(Request $request): ?Request
    {
        try {
            return $this->brokerClient->create($request);
        } catch (GuzzleException $exception) {
            $this->logger->alert("The Request could not be created du to: ". $exception->getMessage());
            return null;
        }
    }

    /**
     * @param string $token
     * @return Request|null
     */
    public function getByToken(string $token): ?Request
    {
        try {
            return $this->brokerClient->getByToken($token);
        } catch (GuzzleException $exception) {
            $this->logger->alert("The Request could not be created du to: ". $exception->getMessage());
            return null;
        }
    }
}