<?php

namespace App\Tests\Domain;

use App\Domain\ReadFilmChoices;
use App\Repository\FilmChoiceRepository;
use PHPUnit\Framework\TestCase;

class ReadFilmChoicesTest extends TestCase
{
    public function testExecute()
    {
    	$repository = $this->createMock(FilmChoiceRepository::class);
        $repository->method('findByUserId')->with('abcd1:abcd2')->willReturn(['foo', 'bar']);

        $readFilmChoices = new ReadFilmChoices($repository);
        $result = $readFilmChoices('abcd1:abcd2');

        $this->assertEquals(['foo', 'bar'], $result);
    }
}