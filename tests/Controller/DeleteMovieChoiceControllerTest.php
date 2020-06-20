<?php

namespace App\Tests\Controller;

use App\Domain\DeleteMovieChoice;
use App\Entity\MovieChoice;
use App\Controller\DeleteMovieChoiceController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteMovieChoiceControllerTest extends TestCase
{
    public function testExecute()
    {
    	$movieChoice = $this->createMock(MovieChoice::class);
    	$deleteMovieChoice = $this->createMock(DeleteMovieChoice::class);
        $deleteMovieChoice->method('__invoke')->with('abcd1-abcd2', 'idMovie1')->willReturn($movieChoice);
    	$request = $this->createMock(Request::class);
        $request->method('get')->withConsecutive(['user_uuid'], ['imdbId'])->willReturnOnConsecutiveCalls('abcd1-abcd2', 'idMovie1');

        $controller = new DeleteMovieChoiceController($deleteMovieChoice);
        $response = $controller($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode($movieChoice), $response->getContent());
    }

    public function testWithException()
    {
        $deleteMovieChoice = $this->createMock(DeleteMovieChoice::class);
        $deleteMovieChoice->expects($this->once())->method('__invoke')->willThrowException(new \DomainException('not found'));
        $request = $this->createMock(Request::class);
        $request->method('get')->withConsecutive(['user_uuid'], ['imdbId'])->willReturnOnConsecutiveCalls('abcd1-abcd2', 'idMovie1');

        $controller = new DeleteMovieChoiceController($deleteMovieChoice);
        $response = $controller($request);

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals(json_encode('not found'), $response->getContent());
    }
}