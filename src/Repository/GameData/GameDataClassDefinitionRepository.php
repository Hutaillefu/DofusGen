<?php


namespace App\Repository\GameData;


use App\Entity\GameDataClassDefinition;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class GameDataClassDefinitionRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, GameDataClassDefinition::class);
	}
}