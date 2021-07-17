<?php


namespace App\Command\Import\D2o\Achievement;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\Achievement\AchievementProgress;
use App\Logic\D2oDecoder;
use App\Repository\D2o\Achievement\AchievementProgressRepository;
use Doctrine\ORM\EntityManagerInterface;

class AchievementProgressCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:AchievementProgress';

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AchievementProgressRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): AchievementProgress
	{
		$data = current($data);

		return new AchievementProgress(
			$data['id'],
			$data['name'],
			$data['seasonId']
		);
	}
}