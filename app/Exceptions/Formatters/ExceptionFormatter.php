<?php

namespace App\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter;

class ExceptionFormatter extends BaseFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $status_code = 500;
        if (get_class($e) === 'Illuminate\Validation\ValidationException') {
            $responseData['errors'] = $e->validator->errors();
            $status_code = 422;
        }
        if (method_exists($e, 'getStatusCode')) {
            $status_code = $e->getStatusCode();
        }
        $response->setStatusCode($status_code);
        $responseData['message'] = $e->getMessage();//$this->config['server_error_production'];
        $responseData['status_code'] = $status_code;
        $responseData['code'] = null;
        $responseData['data'] = $response->getData(true);
        if ($this->debug) {
            $responseData['debug'] = [
                'code'   => $e->getCode(),
                'message'   => $e->getMessage(),
                'exception' => (string) $e,
                'line'   => $e->getLine(),
                'file'   => $e->getFile()
            ];
        }
        $response->setData($responseData);
    }
}