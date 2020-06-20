<?php

namespace App\Tests\Domain;

use App\Domain\ReadBestMovie;
use App\Controller\ReadBestMovieController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReadBestMovieControllerTest extends TestCase
{
    public function testExecute()
    {
    	$readBestMovie = $this->createMock(ReadBestMovie::class);
        $readBestMovie->method('__invoke')->willReturn(['foo', 'bar']);

        $controller = new ReadBestMovieController($readBestMovie);
        $response = $controller();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode(['foo', 'bar']), $response->getContent());
    }
}