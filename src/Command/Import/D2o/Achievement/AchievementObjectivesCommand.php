<?php


namespace App\Command\Import\D2o\Achievement;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\Achievement\AchievementObjectives;
use App\Logic\D2oDecoder;
use App\Repository\D2o\Achievement\AchievementObjectivesRepository;
use Doctrine\ORM\EntityManagerInterface;

class AchievementObjectivesCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:AchievementObjectives';

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AchievementObjectivesRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): AchievementObjectives
	{
		$data = current($data);

		$achievementObjective = new AchievementObjectives();
		$achievementObjective->setId($data['id'])
			->setAchievement(null)
			->setOrder($data['order'])
			->setName($data['nameId'])
			->setCriterion($data['criterion']);
		return $achievementObjective;
	}
}