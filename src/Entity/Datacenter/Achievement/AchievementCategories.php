<?php


namespace App\Entity\Datacenter\Achievement;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\D2i\D2iRecord;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\D2o\Achievement\AchievementCategoriesRepository;

/**
 * @Entity(repositoryClass=AchievementCategoriesRepository::class)
 */
class AchievementCategories
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id()
	 */
	private $id;

	/**
	 * @ORM\OneToOne(targetEntity=D2iRecord::class)
	 */
	private $name;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $parentId;

	/**
	 * @ORM\Column(type="string")
	 */
	private $icon;

	/**
	 * @ORM\Column(type="integer",name="`order`")
	 */
	private $order;

	/**
	 * @ORM\Column(type="string")
	 */
	private $color;

	/**
	 * @ORM\OneToMany(targetEntity=Achievements::class,mappedBy="category")
	 */
	private $achievements;

	public function __construct()
	{
		$this->achievements = new ArrayCollection();
	}

	/**
	 * @ORM\Column(type="string")
	 */
	private $visibilityCriterion;

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

	public function getParentId(): int
	{
		return $this->parentId;
	}

	public function setParentId(int $parentId): self
	{
		$this->parentId = $parentId;
		return $this;
	}

	public function getIcon(): string
	{
		return $this->icon;
	}

	public function setIcon(string $icon): self
	{
		$this->icon = $icon;
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

	public function getColor(): string
	{
		return $this->color;
	}

	public function setColor(string $color): self
	{
		$this->color = $color;
		return $this;
	}

	public function getAchievements(): Collection
	{
		return $this->achievements;
	}

	public function addAchievement(Achievements $achievement): self
	{
		if (!$this->achievements->contains($achievement)) {
			$this->achievements[] = $achievement;
			$achievement->setCategory($this);
		}
		return $this;
	}

	public function getVisibilityCriterion(): string
	{
		return $this->visibilityCriterion;
	}

	public function setVisibilityCriterion(string $visibilityCriterion): self
	{
		$this->visibilityCriterion = $visibilityCriterion;
		return $this;
	}


}