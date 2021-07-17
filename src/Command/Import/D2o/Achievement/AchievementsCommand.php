<?php


namespace App\Command\Import\D2o\Achievement;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\Achievement\Achievements;
use App\Logic\D2oDecoder;
use App\Repository\D2o\Achievement\AchievementCategoriesRepository;
use App\Repository\D2o\Achievement\AchievementObjectivesRepository;
use App\Repository\D2o\Achievement\AchievementRewardsRepository;
use App\Repository\D2o\Achievement\AchievementsRepository;
use Doctrine\ORM\EntityManagerInterface;

class AchievementsCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:Achievements';

	private $rewards_repo;
	private $objectives_repo;
	private $categories_repo;

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AchievementsRepository $repo, AchievementRewardsRepository $rewards_repo,
								AchievementObjectivesRepository $objectives_repo, AchievementCategoriesRepository $categories_repo)
	{
		$this->rewards_repo = $rewards_repo;
		$this->objectives_repo = $objectives_repo;
		$this->categories_repo = $categories_repo;
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): Achievements
	{
		$data = current($data);

		$achievement = new Achievements();
		$achievement->setId($data['id'])
			->setName($data['nameId'])
			->setDescription($data['descriptionId'])
			->setIconId($data['iconId'])
			->setPoints($data['points'])
			->setLevel($data['level'])
			->setOrder($data['order'])
			->setAccountLinked($data['accountLinked']);

		$achievement_category = $this->categories_repo->findOneBy(['id' => $data['categoryId']]);
		$achievement->setCategory($achievement_category);

		foreach ($data['objectiveIds'] as $objectiveId) {
			$objective = $this->objectives_repo->findOneBy(['id' => $objectiveId]);
			if ($objective != null)
				$achievement->addObjective($objective);
		}

		foreach ($data['rewardIds'] as $rewardId) {
			$reward = $this->rewards_repo->findOneBy(['id' => $rewardId]);
			if ($reward != null)
				$achievement->addReward($reward);
		}

//		dd($achievement);

		return $achievement;
	}
}