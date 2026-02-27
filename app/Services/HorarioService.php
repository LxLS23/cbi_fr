<?php

namespace App\Services;

use App\Models\Horario;

class HorarioService extends BaseService
{
    public function __construct(Horario $horario)
    {
        parent::__construct($horario);
    }
}
