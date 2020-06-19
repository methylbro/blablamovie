<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait CreationDatetime
{
    /**
     * @ORM\Column(type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
	protected \DatetimeInterface $createdAt;

	public function getCreatedAt(): \DatetimeInterface
	{
		return $this->createdAt;
	}
}