<?php

namespace App\Tests\Domain;

use App\Domain\ReadBestMovie;
use App\Repository\MovieChoiceRepository;
use PHPUnit\Framework\TestCase;

class ReadBestMovieTest extends TestCase
{
    public function testExecute()
    {
    	$repository = $this->createMock(MovieChoiceRepository::class);
        $repository->method('findBestMovies')->willReturn(['foo', 'bar']);

        $readBestMovie = new ReadBestMovie($repository);
        $result = $readBestMovie();

        $this->assertEquals(['foo', 'bar'], $result);
    }
}