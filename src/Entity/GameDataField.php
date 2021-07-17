<?php


namespace App\Entity;


use App\Logic\D2oReader;

class GameDataField
{
	private $name;
	private $type;
	private $innerField;

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


}