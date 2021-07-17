<?php


namespace App\Entity\Datacenter\Achievement;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\D2o\Achievement\AchievementProgressRepository;

/**
 * Class AchievementProgress
 * @package App\Entity\Datacenter
 * @ORM\Entity(repositoryClass=AchievementProgressRepository::class)
 */
class AchievementProgress
{
	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	private $name;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $seasonId;

	public function __construct(int $id, string $name, int $seasonId)
	{
		$this->id = $id;
		$this->name = $name;
		$this->seasonId = $seasonId;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getSeasonId(): int
	{
		return $this->seasonId;
	}


}