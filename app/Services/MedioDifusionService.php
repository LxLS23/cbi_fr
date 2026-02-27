<?php

namespace App\Services;

use App\Models\MedioDifusion;

class MedioDifusionService extends BaseService
{
    public function __construct(MedioDifusion $medioDifusion)
    {
        parent::__construct($medioDifusion);
    }
}
