<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * register_cara_bayar controller
 */
class RegisterCaraBayarController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "RegisterCaraBayarSummary");
    }
}
