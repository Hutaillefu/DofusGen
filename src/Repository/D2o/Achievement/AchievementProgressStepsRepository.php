<?php


namespace App\Repository\D2o\Achievement;


use App\Entity\Datacenter\Achievement\AchievementProgressSteps;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class AchievementProgressStepsRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AchievementProgressSteps::class);
	}
}