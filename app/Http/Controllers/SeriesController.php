<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Serie;

class SeriesController extends BaseController
{

    public function __construct() {
        $resource = Serie::class;
        $this->resource = new $resource;
    }

}
