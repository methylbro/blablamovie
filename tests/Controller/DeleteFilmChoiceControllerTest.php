<?php

namespace App\Tests\Controller;

use App\Domain\DeleteFilmChoice;
use App\Entity\FilmChoice;
use App\Controller\DeleteFilmChoiceController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteFilmChoiceControllerTest extends TestCase
{
    public function testExecute()
    {
    	$filmchoice = $this->createMock(FilmChoice::class);
    	$deleteFilmChoice = $this->createMock(DeleteFilmChoice::class);
        $deleteFilmChoice->method('__invoke')->with('abcd1-abcd2', 'idfilm1')->willReturn($filmchoice);
    	$request = $this->createMock(Request::class);
        $request->method('get')->withConsecutive(['user_uuid'], ['imdbId'])->willReturnOnConsecutiveCalls('abcd1-abcd2', 'idfilm1');

        $controller = new DeleteFilmChoiceController($deleteFilmChoice);
        $response = $controller($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode($filmchoice), $response->getContent());
    }

    public function testWithException()
    {
        $deleteFilmChoice = $this->createMock(DeleteFilmChoice::class);
        $deleteFilmChoice->expects($this->once())->method('__invoke')->willThrowException(new \DomainException('not found'));
        $request = $this->createMock(Request::class);
        $request->method('get')->withConsecutive(['user_uuid'], ['imdbId'])->willReturnOnConsecutiveCalls('abcd1-abcd2', 'idfilm1');

        $controller = new DeleteFilmChoiceController($deleteFilmChoice);
        $response = $controller($request);

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals(json_encode('not found'), $response->getContent());
    }
}