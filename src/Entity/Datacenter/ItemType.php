<?php


namespace App\Entity\Datacenter;

use App\Repository\D2o\ItemTypeRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\D2i\D2iRecord;

/**
 * @ORM\Entity(repositoryClass=ItemTypeRepository::class)
 */
class ItemType
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
	 * @ORM\Column(type="integer", nullable=false)
	 */
	private $superTypeId;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	private $categoryId;

	/**
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	private $isInEncyclopedia;

	/**
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	private $plural;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	private $gender;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	private $rawZone;

	/**
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	private $mimickable;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	private $craftXpRatio;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	private $evolutiveTypeId;

	public function __construct()
	{
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id): self
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName(?D2iRecord $name): self
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSuperTypeId()
	{
		return $this->superTypeId;
	}

	/**
	 * @param mixed $superTypeId
	 */
	public function setSuperTypeId($superTypeId): self
	{
		$this->superTypeId = $superTypeId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCategoryId()
	{
		return $this->categoryId;
	}

	/**
	 * @param mixed $categoryId
	 */
	public function setCategoryId($categoryId): self
	{
		$this->categoryId = $categoryId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIsInEncyclopedia()
	{
		return $this->isInEncyclopedia;
	}

	/**
	 * @param mixed $isInEncyclopedia
	 */
	public function setIsInEncyclopedia($isInEncyclopedia): self
	{
		$this->isInEncyclopedia = $isInEncyclopedia;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPlural()
	{
		return $this->plural;
	}

	/**
	 * @param mixed $plural
	 */
	public function setPlural($plural): self
	{
		$this->plural = $plural;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param mixed $gender
	 */
	public function setGender($gender): self
	{
		$this->gender = $gender;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getRawZone()
	{
		return $this->rawZone;
	}

	/**
	 * @param mixed $rawZone
	 */
	public function setRawZone($rawZone): self
	{
		$this->rawZone = $rawZone;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMimickable()
	{
		return $this->mimickable;
	}

	/**
	 * @param mixed $mimickable
	 */
	public function setMimickable($mimickable): self
	{
		$this->mimickable = $mimickable;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCraftXpRatio()
	{
		return $this->craftXpRatio;
	}

	/**
	 * @param mixed $craftXpRatio
	 */
	public function setCraftXpRatio($craftXpRatio): self
	{
		$this->craftXpRatio = $craftXpRatio;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEvolutiveTypeId()
	{
		return $this->evolutiveTypeId;
	}

	/**
	 * @param mixed $evolutiveTypeId
	 */
	public function setEvolutiveTypeId($evolutiveTypeId): self
	{
		$this->evolutiveTypeId = $evolutiveTypeId;
		return $this;
	}



}