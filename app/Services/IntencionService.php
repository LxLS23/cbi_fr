<?php

namespace App\Services;

use App\Models\Intencion;

class IntencionService extends BaseService
{
    public function __construct(Intencion $model)
    {
        parent::__construct($model);
    }
}
