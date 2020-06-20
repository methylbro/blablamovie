<?php

namespace App\Tests\Domain;

use App\Domain\DeleteMovieChoice;
use App\Entity\MovieChoice;
use App\Repository\MovieChoiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class DeleteMovieChoiceTest extends TestCase
{
    public function testExecute()
    {
    	$movieChoice = $this->createMock(MovieChoice::class);
    	$repository = $this->createMock(MovieChoiceRepository::class);
        $repository->method('findOne')->with('abcd1-abcd2', 'film1')->willReturn($movieChoice);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->method('getRepository')->with(MovieChoice::class)->willReturn($repository);
        $entityManager->method('remove')->with($movieChoice);

        $deleteMovieChoice = new DeleteMovieChoice($entityManager);
        $result = $deleteMovieChoice('abcd1-abcd2', 'film1');

        $this->assertEquals($movieChoice, $result);
    }

    public function testWithException()
    {
    	$repository = $this->createMock(MovieChoiceRepository::class);
        $repository->method('findOne')->with('abcd1-abcd2', 'film1')->willReturn(null);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->method('getRepository')->with(MovieChoice::class)->willReturn($repository);

        $this->expectException(\DomainException::class);

        $deleteMovieChoice = new DeleteMovieChoice($entityManager);
        $result = $deleteMovieChoice('abcd1-abcd2', 'film1');
    }
}