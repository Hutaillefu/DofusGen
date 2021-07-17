<?php


namespace App\Command\Import\D2o\Achievement;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\Achievement\AchievementProgressSteps;
use App\Logic\D2oDecoder;
use App\Repository\D2o\Achievement\AchievementProgressStepsRepository;
use Doctrine\ORM\EntityManagerInterface;

class AchievementProgressStepsCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:AchievementProgressSteps';

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AchievementProgressStepsRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): AchievementProgressSteps
	{
		$data = current($data);

		return new AchievementProgressSteps(
			$data['id'],
			$data['progressId'],
			$data['score'],
			$data['isCosmetic'],
			$data['achievementId']
		);
	}
}