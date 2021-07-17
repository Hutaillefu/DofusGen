<?php


namespace App\Repository\D2o\Achievement;


use App\Entity\Datacenter\Achievement\AchievementRewards;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class AchievementRewardsRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AchievementRewards::class);
	}
}