<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Serie;

class EpisodiosController extends BaseController
{

    public function __construct() {
        $resource = Episodio::class;
        $this->resource = new $resource;
    }
    
    public function buscaPorSerie(int $serie_id)
    {
        $episodios = Episodio::query()->where('serie_id', $serie_id)->paginate();
        return response()->json($episodios, 200);
    }

}
