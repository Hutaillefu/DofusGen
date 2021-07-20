<?php


namespace App\Entity;


use App\Logic\D2oReader;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameData\GameDataFieldRepository;
use phpDocumentor\Reflection\Utils;

/**
 * Class GameDataField
 * @package App\Entity
 * @ORM\Entity(repositoryClass=GameDataFieldRepository::class)
 */
class GameDataField
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
	 * @ORM\Column(type="integer")
	 */
	private $type;

	/**
	 * @ORM\OneToOne(targetEntity=GameDataField::class, cascade={"persist"})
	 */
	private $innerField;

	/**
	 * @ORM\ManyToOne(targetEntity=GameDataClassDefinition::class, inversedBy="fields", cascade={"persist"})
	 */
	private $gameDataClassDefinition;

	public function __construct(D2oReader $reader)
	{
		$this->name = $reader->readUtf8();
		$this->readType($reader);
	}

	private function readType(D2oReader $reader)
	{
		$this->type = $reader->readInt();

		if ($this->type == -99)
			$this->innerField = new GameDataField($reader);
	}


	public function getName(): string
	{
		return $this->name;
	}

	public function getType(): int
	{
		return $this->type;
	}

	public function getInnerField(): ?GameDataField
	{
		return $this->innerField;
	}

	public function getGameDataClassDefinition(): GameDataClassDefinition
	{
		return $this->gameDataClassDefinition;
	}

	public function setGameDataClassDefinition(GameDataClassDefinition $gameDataClassDefinition): self
	{
		$this->gameDataClassDefinition = $gameDataClassDefinition;
		return $this;
	}

}