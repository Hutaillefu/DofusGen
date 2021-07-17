<?php


namespace App\Entity\Datacenter\Achievement;


use App\Repository\D2o\Achievement\AchievementRewardsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AchievementRewards
 * @package App\Entity\Datacenter\Achievement
 * @ORM\Entity(repositoryClass=AchievementRewardsRepository::class)
 */
class AchievementRewards
{
	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity=Achievements::class, inversedBy="rewards", cascade={"remove"})
	 */
	private $achievement;

	/**
	 * @ORM\Column(type="string")
	 */
	private $criteria;

	/**
	 * @ORM\Column(type="float")
	 */
	private $kamasRatio;

	/**
	 * @ORM\Column(type="float")
	 */
	private $experienceRatio;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $kamasScaleWithPlayerLevel;

	/**
	 * @ORM\Column(type="array")
	 */
	private $itemsReward;

	/**
	 * @ORM\Column(type="array")
	 */
	private $itemsQuantityReward;

	/**
	 * @ORM\Column(type="array")
	 */
	private $emotesReward;

	/**
	 * @ORM\Column(type="array")
	 */
	private $spellsReward;

	/**
	 * @ORM\Column(type="array")
	 */
	private $titlesReward;

	/**
	 * @ORM\Column(type="array")
	 */
	private $ornamentsReward;

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

	public function getCriteria(): string
	{
		return $this->criteria;
	}

	public function setCriteria(string $criteria): self
	{
		$this->criteria = $criteria;
		return $this;
	}

	public function getKamasRatio(): float
	{
		return $this->kamasRatio;
	}

	public function setKamasRatio(float $kamasRatio): self
	{
		$this->kamasRatio = $kamasRatio;
		return $this;
	}

	public function getExperienceRatio(): float
	{
		return $this->experienceRatio;
	}

	public function setExperienceRatio(float $experienceRatio): self
	{
		$this->experienceRatio = $experienceRatio;
		return $this;
	}

	public function getKamasScaleWithPlayerLevel(): bool
	{
		return $this->kamasScaleWithPlayerLevel;
	}

	public function setKamasScaleWithPlayerLevel(bool $kamasScaleWithPlayerLevel): self
	{
		$this->kamasScaleWithPlayerLevel = $kamasScaleWithPlayerLevel;
		return $this;
	}

	public function getItemsReward(): array
	{
		return $this->itemsReward;
	}

	public function setItemsReward(array $itemsReward): self
	{
		$this->itemsReward = $itemsReward;
		return $this;
	}

	public function getItemsQuantityReward(): array
	{
		return $this->itemsQuantityReward;
	}

	public function setItemsQuantityReward(array $itemsQuantityReward): self
	{
		$this->itemsQuantityReward = $itemsQuantityReward;
		return $this;
	}

	public function getEmotesReward(): array
	{
		return $this->emotesReward;
	}

	public function setEmotesReward($emotesReward): self
	{
		$this->emotesReward = $emotesReward;
		return $this;
	}

	public function getSpellsReward(): array
	{
		return $this->spellsReward;
	}

	public function setSpellsReward(array $spellsReward): self
	{
		$this->spellsReward = $spellsReward;
		return $this;
	}

	public function getTitlesReward(): array
	{
		return $this->titlesReward;
	}

	public function setTitlesReward(array $titlesReward): self
	{
		$this->titlesReward = $titlesReward;
		return $this;
	}

	public function getOrnamentsReward(): array
	{
		return $this->ornamentsReward;
	}

	public function setOrnamentsReward(array $ornamentsReward): self
	{
		$this->ornamentsReward = $ornamentsReward;
		return $this;
	}


}