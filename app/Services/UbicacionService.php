<?php

namespace App\Services;

use App\Models\Ubicacion;

class UbicacionService extends BaseService
{
    public function __construct(Ubicacion $ubicacion)
    {
        parent::__construct($ubicacion);
    }
}
