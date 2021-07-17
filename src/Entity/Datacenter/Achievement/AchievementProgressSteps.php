<?php


namespace App\Entity\Datacenter\Achievement;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\D2o\Achievement\AchievementProgressStepsRepository;

/**
 * @ORM\Entity(repositoryClass=AchievementProgressStepsRepository::class)
 */
class AchievementProgressSteps
{
	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $progressId;

	/**
	 * @ORM\Column(type="integer", name="`score`")
	 */
	private $score;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $isCosmetic;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $achievementId;

	public function __construct(int $id, int $progressId, int $score, bool $isCosmetic, int $achievementId)
	{
		$this->id = $id;
		$this->progressId = $progressId;
		$this->score = $score;
		$this->isCosmetic = $isCosmetic;
		$this->achievementId = $achievementId;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getProgressId(): int
	{
		return $this->progressId;
	}

	public function getScore(): int
	{
		return $this->score;
	}

	public function isCosmetic(): bool
	{
		return $this->isCosmetic;
	}

	public function getAchievementId(): int
	{
		return $this->achievementId;
	}

}