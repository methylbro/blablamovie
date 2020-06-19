<?php

namespace App\Tests\Domain;

use App\Domain\ReadFilmChoices;
use App\Controller\ReadFilmChoicesController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ReadFilmChoicesControllerTest extends TestCase
{
    public function testExecute()
    {
    	$readFilmChoices = $this->createMock(ReadFilmChoices::class);
        $readFilmChoices->method('__invoke')->with('abcd1:abcd2')->willReturn(['foo', 'bar']);

        $request = $this->createMock(Request::class);
        $request->method('get')->with('user_uuid')->willReturn('abcd1:abcd2');

        $controller = new ReadFilmChoicesController($readFilmChoices);
        $response = $controller($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode(['foo', 'bar']), $response->getContent());
    }
}