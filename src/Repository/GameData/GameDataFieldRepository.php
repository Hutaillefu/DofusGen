<?php


namespace App\Repository\GameData;


use App\Entity\GameDataField;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class GameDataFieldRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, GameDataField::class);
	}
}