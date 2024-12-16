<?php

namespace Trcosta97\BuscadorCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class BuscadorDeCursos
{
    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url)
    {
        $resposta = $this->httpClient->request('GET', $url);
        $html = $resposta->getBody();

        $crawler = new Crawler();
        $crawler->addHtmlContent($html);

        $elementosCursos = $crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }
}
