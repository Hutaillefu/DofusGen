<?php


namespace App\Repository\D2o\Achievement;


use App\Entity\Datacenter\Achievement\AchievementCategories;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class AchievementCategoriesRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AchievementCategories::class);
	}
}