<?php

namespace App\Services;

use App\Models\Tramite;

class TramiteService extends BaseService
{
    public function __construct(Tramite $model)
    {
        parent::__construct($model);
    }
}
