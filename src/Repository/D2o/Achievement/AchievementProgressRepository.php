<?php


namespace App\Repository\D2o\Achievement;


use App\Entity\Datacenter\Achievement\AchievementProgress;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class AchievementProgressRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AchievementProgress::class);
	}
}