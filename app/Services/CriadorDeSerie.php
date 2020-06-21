<?php
namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{

    public function criarSerie(string $nomeSerie, int $qtdTemporada, int $epPorTemporada) : Serie
    {
        $serie = null;
        DB::beginTransaction();
            $serie = Serie::create(['nome' => $nomeSerie]);
            $this->criaTemporadas($qtdTemporada, $serie, $epPorTemporada);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $qtdTemporada
     * @param $serie
     * @param int $epPorTemporada
     */
    private function criaTemporadas(int $qtdTemporada, $serie, int $epPorTemporada): void
    {
        for ($i = 1; $i <= $qtdTemporada; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     */
    private function criaEpisodios(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
