<?php


namespace App\Entity;


use App\Logic\D2oReader;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameData\GameDataClassDefinitionRepository;

/**
 * Class GameDataClassDefinition
 * @package App\Entity
 * @ORM\Entity(repositoryClass=GameDataClassDefinitionRepository::class)
 */
class GameDataClassDefinition
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	private $name;

	/**
	 * @ORM\OneToMany(targetEntity=GameDataField::class, mappedBy="gameDataClassDefinition", cascade={"persist"})
	 */
	private $fields;

	/**
	 * @ORM\ManyToOne(targetEntity=FileVersion::class, inversedBy="gameDataClassDefinitions", cascade={"persist"})
	 */
	private $fileVersion;

	public function __construct($name)
	{
		$this->name = $name;
		$this->fields = new ArrayCollection();
	}

	public function addField(D2oReader $reader): self
	{
		$field = new GameDataField($reader);
		$this->fields[] = $field;
		$field->setGameDataClassDefinition($this);
		return $this;
	}

	public function getFields(): Collection
	{
		return $this->fields;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getFileVersion(): FileVersion
	{
		return $this->fileVersion;
	}

	public function setFileVersion(FileVersion $fileVersion): self
	{
		$this->fileVersion = $fileVersion;
		return $this;
	}


}