<?php

namespace App\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Exceptions\Formatters\ExceptionFormatter;


class HttpExceptionFormatter extends ExceptionFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        parent::format($response, $e, $reporterResponses);

        $response->setStatusCode($e->getStatusCode());
    }
}
