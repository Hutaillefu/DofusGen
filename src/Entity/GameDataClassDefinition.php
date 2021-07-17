<?php


namespace App\Entity;


use App\Logic\D2oReader;

class GameDataClassDefinition
{
	private $name;
	private $fields;

	public function __construct($name)
	{
		$this->name = $name;
		$this->fields = [];
	}

	public function addField(D2oReader $reader)
	{
		$field = new GameDataField($reader);
		$this->fields[] = $field;
	}

	/**
	 * @return array
	 */
	public function getFields(): array
	{
		return $this->fields;
	}

	public function getName(): string
	{
		return $this->name;
	}


}