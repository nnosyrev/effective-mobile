<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'L5 OpenApi',
    description: 'L5 Swagger OpenApi description',
)]
abstract readonly class Controller
{
    //
}
