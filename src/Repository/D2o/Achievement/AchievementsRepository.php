<?php


namespace App\Repository\D2o\Achievement;


use App\Entity\Datacenter\Achievement\Achievements;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class AchievementsRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Achievements::class);
	}
}