<?php

namespace App\Tests\Domain;

use App\Domain\ReadUsersWithMovieChoice;
use App\Controller\ReadUsersWithMovieChoiceController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReadUsersWithMovieChoiceControllerTest extends TestCase
{
    public function testExecute()
    {
    	$readUsersWithMovieChoice = $this->createMock(ReadUsersWithMovieChoice::class);
        $readUsersWithMovieChoice->method('__invoke')->willReturn(['foo', 'bar']);

        $controller = new ReadUsersWithMovieChoiceController($readUsersWithMovieChoice);
        $response = $controller();

        $this->assertEquals(json_encode(['foo', 'bar']), $response->getContent());
    }
}