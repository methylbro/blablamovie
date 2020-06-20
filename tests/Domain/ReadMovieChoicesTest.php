<?php

namespace App\Tests\Domain;

use App\Domain\ReadMovieChoices;
use App\Repository\MovieChoiceRepository;
use PHPUnit\Framework\TestCase;

class ReadMovieChoicesTest extends TestCase
{
    public function testExecute()
    {
    	$repository = $this->createMock(MovieChoiceRepository::class);
        $repository->method('findByUserId')->with('abcd1:abcd2')->willReturn(['foo', 'bar']);

        $readMovieChoices = new ReadMovieChoices($repository);
        $result = $readMovieChoices('abcd1:abcd2');

        $this->assertEquals(['foo', 'bar'], $result);
    }
}