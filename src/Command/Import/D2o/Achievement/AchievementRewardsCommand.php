<?php


namespace App\Command\Import\D2o\Achievement;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\Achievement\AchievementRewards;
use App\Logic\D2oDecoder;
use App\Repository\D2o\Achievement\AchievementRewardsRepository;
use Doctrine\ORM\EntityManagerInterface;

class AchievementRewardsCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:AchievementRewards';

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AchievementRewardsRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): AchievementRewards
	{
		$data = current($data);

		$achievementReward = new AchievementRewards();
		$achievementReward->setId($data['id'])
			->setAchievement(null)
			->setCriteria($data['criteria'])
			->setKamasRatio($data['kamasRatio'])
			->setExperienceRatio($data['experienceRatio'])
			->setKamasScaleWithPlayerLevel($data['kamasScaleWithPlayerLevel'])
			->setItemsReward($data['itemsReward'])
			->setItemsQuantityReward($data['itemsQuantityReward'])
			->setEmotesReward($data['emotesReward'])
			->setSpellsReward($data['spellsReward'])
			->setTitlesReward($data['titlesReward'])
			->setOrnamentsReward($data['ornamentsReward']);
		return $achievementReward;
	}
}