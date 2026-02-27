<?php

namespace App\Services;

use App\Models\Documento;

class DocumentoService extends BaseService
{
    public function __construct(Documento $documento)
    {
        parent::__construct($documento);
    }
}
