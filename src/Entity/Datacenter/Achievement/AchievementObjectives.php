<?php


namespace App\Entity\Datacenter\Achievement;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\D2o\Achievement\AchievementObjectivesRepository;
use App\Entity\D2i\D2iRecord;

/**
 * Class AchievementObjectives
 * @package App\Entity\Datacenter
 * @ORM\Entity(repositoryClass=AchievementObjectivesRepository::class)
 */
class AchievementObjectives
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id()
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity=Achievements::class, inversedBy="objectives")
	 */
	private $achievement;

	/**
	 * @ORM\Column(type="integer", name="`order`")
	 */
	private $order;

	/**
	 * @ORM\OneToOne(targetEntity=D2iRecord::class)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string")
	 */
	private $criterion;


	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function getAchievement(): ?Achievements
	{
		return $this->achievement;
	}

	public function setAchievement(?Achievements $achievement): self
	{
		$this->achievement = $achievement;
		return $this;
	}

	public function getOrder(): int
	{
		return $this->order;
	}

	public function setOrder(int $order): self
	{
		$this->order = $order;
		return $this;
	}

	public function getName(): ?D2iRecord
	{
		return $this->name;
	}

	public function setName(?D2iRecord $name): self
	{

		$this->name = $name;
		return $this;
	}

	public function getCriterion(): string
	{
		return $this->criterion;
	}

	public function setCriterion(string $criterion): self
	{
		$this->criterion = $criterion;
		return $this;
	}


}