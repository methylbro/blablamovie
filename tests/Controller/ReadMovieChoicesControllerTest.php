<?php

namespace App\Tests\Domain;

use App\Domain\ReadMovieChoices;
use App\Controller\ReadMovieChoicesController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ReadMovieChoicesControllerTest extends TestCase
{
    public function testExecute()
    {
    	$readMovieChoices = $this->createMock(ReadMovieChoices::class);
        $readMovieChoices->method('__invoke')->with('abcd1:abcd2')->willReturn(['foo', 'bar']);

        $request = $this->createMock(Request::class);
        $request->method('get')->with('user_uuid')->willReturn('abcd1:abcd2');

        $controller = new ReadMovieChoicesController($readMovieChoices);
        $response = $controller($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode(['foo', 'bar']), $response->getContent());
    }
}