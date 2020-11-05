<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class AppError extends HttpException
{
    public function __construct(
        int $statusCode,
        string $message = null,
        Throwable $previous = null,
        array $headers = [],
        ?int $code = 0
    )
    {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}
