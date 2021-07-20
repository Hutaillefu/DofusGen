<?php


namespace App\Command\Import\D2o\Achievement;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\Achievement\AchievementProgressSteps;
use App\Logic\D2oDecoder;
use App\Repository\D2o\Achievement\AchievementProgressRepository;
use App\Repository\D2o\Achievement\AchievementProgressStepsRepository;
use App\Repository\D2o\Achievement\AchievementsRepository;
use Doctrine\ORM\EntityManagerInterface;

class AchievementProgressStepsCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:AchievementProgressSteps';

	private $progress_repo;
	private $achievement_repo;

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AchievementProgressStepsRepository $repo, AchievementProgressRepository $progress_repo,
								AchievementsRepository $achievement_repo)
	{
		$this->progress_repo = $progress_repo;
		$this->achievement_repo = $achievement_repo;
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): AchievementProgressSteps
	{
		$data = current($data);

		$achievement_progress = $this->progress_repo->findOneBy(['id' => $data['progressId']]);
		$achievement = $this->achievement_repo->findOneBy(['id' => $data['achievementId']]);

		return new AchievementProgressSteps(
			$data['id'],
			$achievement_progress,
			$data['score'],
			$data['isCosmetic'],
			$achievement
		);
	}
}