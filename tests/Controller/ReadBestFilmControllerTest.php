<?php

namespace App\Tests\Domain;

use App\Domain\ReadBestFilm;
use App\Controller\ReadBestFilmController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReadBestFilmControllerTest extends TestCase
{
    public function testExecute()
    {
    	$readBestFilm = $this->createMock(ReadBestFilm::class);
        $readBestFilm->method('__invoke')->willReturn(['foo', 'bar']);

        $controller = new ReadBestFilmController($readBestFilm);
        $response = $controller();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode(['foo', 'bar']), $response->getContent());
    }
}