<?php

namespace App\Services;

use App\Models\Area;

class AreaService extends BaseService
{
    public function __construct(Area $area)
    {
        parent::__construct($area);
    }
}
