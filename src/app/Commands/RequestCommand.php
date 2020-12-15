<?php

namespace App\Commands;

use App\Services\RequestService;

class RequestCommand
{
    /**
     * @var RequestService
     */
    private RequestService $requestService;

    /**
     * RequestCommand constructor.
     * @param RequestService $requestService
     */
    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    /**
     * Executes the command
     * @return string
     */
    public function execute()
    {
        set_time_limit(0);

        $request = $this->requestService->createAndSend();
        if (!$request) {
            return "Error cannot create the Request";
        }

        $continue = true;
        $token = $request->getToken();
        $timeBetweenRequests = 50000;
        $maxTimeAllowed = 1000000;
        $timePassed = 0;
        while($continue) {

            $request = $this->requestService->getByToken($token);

            $continue = ($request->getStatus() != "farewell")?
                $timePassed <= $maxTimeAllowed : false;


            $timePassed += $timeBetweenRequests;
            usleep($timeBetweenRequests);
        }

        return ($request->getStatus() === "farewell")?$request->getMessage():"no response";
    }
}