<?php

namespace App\Services;

use App\Models\PreguntaChat;

class PreguntaChatService extends BaseService
{
    public function __construct(PreguntaChat $model)
    {
        parent::__construct($model);
    }
}
