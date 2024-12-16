<?php 

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Trcosta97\BuscadorCursos\BuscadorDeCursos;

$client = new Client(['verify' => false, 'base_uri' => 'https://www.alura.com.br']);
$crawler = new Crawler();

$buscador = new BuscadorDeCursos($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo exibirMensagem($curso);
}

