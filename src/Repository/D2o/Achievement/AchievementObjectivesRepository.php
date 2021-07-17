<?php


namespace App\Repository\D2o\Achievement;


use App\Entity\Datacenter\Achievement\AchievementObjectives;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class AchievementObjectivesRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AchievementObjectives::class);
	}
}