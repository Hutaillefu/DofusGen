<?php


namespace App\Command\Import\D2o\Achievement;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\Achievement\AchievementCategories;
use App\Logic\D2oDecoder;
use App\Repository\D2o\Achievement\AchievementCategoriesRepository;;
use Doctrine\ORM\EntityManagerInterface;

class AchievementCategoriesCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:AchievementCategories';

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AchievementCategoriesRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): AchievementCategories
	{
		$data = current($data);
//		dd	($data);
		$achievementCategorie = new AchievementCategories();
		$achievementCategorie
			->setId($data['id'])
			->setName($data['nameId'])
			->setParentId($data['parentId'])
			->setIcon($data['icon'])
			->setOrder($data['order'])
			->setColor($data['color'])
//			->setAchievementIds($data['achievementIds'])
			->setVisibilityCriterion($data['visibilityCriterion']);
//		dd($achievementCategorie);
		return $achievementCategorie;
	}
}