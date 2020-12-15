<?php

namespace Framework\Cli;

use App\Services\RequestService;
use Exception;
use Framework\Utils\Configuration\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Handler
{
    /**
     * @var ContainerBuilder|null
     */
    private ?ContainerBuilder $container;

    /**
     * Handler constructor.
     * @param ContainerBuilder|null $container
     */
    public function __construct(
        ?ContainerBuilder $container
    ) {
        $this->container = $container;
    }

    /**
     * @param ConfigurationInterface $input
     * @return string
     * @throws Exception
     */
    public function execute(ConfigurationInterface  $input)
    {
        if (!$input->has("--command")) {
            $this->container->get("logger")->alert("Which command do you want to execute? 
                                                        The 'command' argument should be present");
            return "Invalid command input";
        }

        $command = $this->container->get($input->get("--command"));

        return $command->execute();
    }
}