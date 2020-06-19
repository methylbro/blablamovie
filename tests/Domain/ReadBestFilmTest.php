<?php

namespace App\Tests\Domain;

use App\Domain\ReadBestFilm;
use App\Repository\FilmChoiceRepository;
use PHPUnit\Framework\TestCase;

class ReadBestFilmTest extends TestCase
{
    public function testExecute()
    {
    	$repository = $this->createMock(FilmChoiceRepository::class);
        $repository->method('findBestFilms')->willReturn(['foo', 'bar']);

        $readBestFilm = new ReadBestFilm($repository);
        $result = $readBestFilm();

        $this->assertEquals(['foo', 'bar'], $result);
    }
}