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
	 * @ORM\ManyToOne(targetEntity=AchievementProgress::class)
	 */
	private $progress;

	/**
	 * @ORM\Column(type="integer", name="`score`")
	 */
	private $score;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $isCosmetic;

	/**
	 * @ORM\ManyToOne(targetEntity=Achievements::class)
	 */
	private $achievement;

	public function __construct(int $id, AchievementProgress $progress, int $score, bool $isCosmetic, Achievements $achievement = null)
	{
		$this->id = $id;
		$this->progress = $progress;
		$this->score = $score;
		$this->isCosmetic = $isCosmetic;
		$this->achievement = $achievement;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getProgress(): AchievementProgress
	{
		return $this->progress;
	}

	public function getScore(): int
	{
		return $this->score;
	}

	public function isCosmetic(): bool
	{
		return $this->isCosmetic;
	}

	public function getAchievement(): ?Achievements
	{
		return $this->achievement;
	}

}