<?php


namespace App\Entity\Datacenter\Achievement;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\D2o\Achievement\AchievementsRepository;
use App\Entity\D2i\D2iRecord;

/**
 * Class Achievements
 * @package App\Entity\Datacenter\Achievement
 * @ORM\Entity(repositoryClass=AchievementsRepository::class)
 */
class Achievements
{
	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\OneToOne(targetEntity=D2iRecord::class)
	 */
	private $name;

	/**
	 * @ORM\ManyToOne(targetEntity=AchievementCategories::class, cascade={"persist","remove"}, inversedBy="achievements")
	 */
	private $category;

	/**
	 * @ORM\OneToOne(targetEntity=D2iRecord::class)
	 */
	private $description;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $iconId;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $points;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $level;

	/**
	 * @ORM\Column(type="integer", name="`order")
	 */
	private $order;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $accountLinked;

	/**
	 * @ORM\OneToMany(targetEntity=AchievementObjectives::class, mappedBy="achievement", cascade={"remove"})
	 */
	private $objectives;

	/**
	 * @ORM\OneToMany(targetEntity=AchievementRewards::class, mappedBy="achievement", cascade={"remove"})
	 */
	private $rewards;

	public function __construct()
	{
		$this->objectives = new ArrayCollection();
		$this->rewards = new ArrayCollection();
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function getName(): D2iRecord
	{
		return $this->name;
	}

	public function setName(D2iRecord $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function getCategory(): AchievementCategories
	{
		return $this->category;
	}

	public function setCategory(AchievementCategories $category): self
	{
		$this->category = $category;
		return $this;
	}

	public function getDescription(): D2iRecord
	{
		return $this->description;
	}

	public function setDescription(D2iRecord $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getIconId(): int
	{
		return $this->iconId;
	}

	public function setIconId(int $iconId): self
	{
		$this->iconId = $iconId;
		return $this;
	}

	public function getPoints(): int
	{
		return $this->points;
	}

	public function setPoints(int $points): self
	{
		$this->points = $points;
		return $this;
	}

	public function getLevel(): int
	{
		return $this->level;
	}

	public function setLevel(int $level): self
	{
		$this->level = $level;
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

	public function getAccountLinked(): bool
	{
		return $this->accountLinked;
	}

	public function setAccountLinked(bool $accountLinked): self
	{
		$this->accountLinked = $accountLinked;
		return $this;
	}

	public function getObjectives(): Collection
	{
		return $this->objectives;
	}

	public function addObjective(AchievementObjectives $objective): self
	{
		if (!$this->objectives->contains($objective)) {
			$this->objectives[] = $objective;
			$objective->setAchievement($this);
		}
		return $this;
	}

	public function getRewards(): Collection
	{
		return $this->rewards;
	}

	public function addReward(AchievementRewards $reward): self
	{
		if (!$this->rewards->contains($reward)) {
			$this->rewards[] = $reward;
			$reward->setAchievement($this);
		}
		return $this;
	}


}