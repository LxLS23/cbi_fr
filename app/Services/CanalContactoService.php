<?php

namespace App\Services;

use App\Models\CanalContacto;

class CanalContactoService extends BaseService
{
    public function __construct(CanalContacto $canalContacto)
    {
        parent::__construct($canalContacto);
    }
}
