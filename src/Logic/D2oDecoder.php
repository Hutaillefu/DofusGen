<?php


namespace App\Logic;


use App\Entity\GameDataClassDefinition;
use App\Entity\GameDataField;
use App\Repository\D2iRecordRepository;

class D2oDecoder implements IDecoder
{
	private $filename;
	private $reader;
	private $stream;

	private $d2i_repo;

	private $objectPointerTable;
	private $classDefinitions;

	public function __construct(D2iRecordRepository $d2i_repo, string $filename = "")
	{
		$this->reader = new D2oReader();
		$this->filename = $filename;
		$this->d2i_repo = $d2i_repo;
	}

	public function begin(string $filename)
	{
		$this->filename = $filename;
		$this->stream = fopen($this->filename, 'r');
	}

	public function end()
	{
		fclose($this->stream);
	}

	public function initIndexTable()
	{
		$this->objectPointerTable = [];
		$this->classDefinitions = [];

		$this->reader->setStream($this->stream);
		$this->reader->setPosition(0);


		$header = $this->reader->readAscii(3);
		$this->readObjectPointerTable();
		$this->readClassTable();
	}

	private function readObjectPointerTable()
	{
		$tablePointer = $this->reader->readInt();
		$this->reader->setPosition($tablePointer);

		$tableLen = $this->reader->readInt();
		for ($i = 0; $i < $tableLen; $i += 8) {
			$key = $this->reader->readInt();
			$pointer = $this->reader->readInt();
			$this->objectPointerTable[$key] = $pointer;
		}
	}

	private function readClassTable()
	{
		$classCount = $this->reader->readInt();

		$i = 0;
		while ($i < $classCount) {
			$classId = $this->reader->readInt();
			$this->readClassDefinition($classId);
			$i++;
		}
	}

	private function readClassDefinition(int $classId): void
	{
		$className = $this->reader->readUtf8();
		$packageName = $this->reader->readUtf8();
		$fieldsCount = $this->reader->readInt();

		$classDefinition = new GameDataClassDefinition($className);

		for ($i = 0; $i < $fieldsCount; $i++) {
			$classDefinition->addField($this->reader);
		}
		$this->classDefinitions[$classId] = $classDefinition;
	}

	public function searchById(int $id): array
	{
		$objectPointer = $this->objectPointerTable[$id];
		$this->reader->setPosition($objectPointer);

		$objectClassId = $this->reader->readInt();
		return $this->getObjectBuilder($objectClassId);
	}

	private function getObjectBuilder(int $classId): array
	{
		$res = [];
		$classDefinition = $this->classDefinitions[$classId];
		$res[$classDefinition->getName()] = $this->getFieldsBuilder($classDefinition);
		return $res;
	}

	private function getFieldsBuilder(GameDataClassDefinition $classDefinition): array
	{
		$res = [];
		$nbFields = count($classDefinition->getFields());
		for ($i = 0; $i < $nbFields; $i++) {
			$fieldName = $classDefinition->getFields()[$i]->getName();
			$fieldValue = $this->getFieldValue($classDefinition->getFields()[$i]);
			$res[$fieldName] = $fieldValue;
		}
		return $res;
	}

	private function getFieldValue(GameDataField $field)
	{
		switch ($field->getType()) {
			case -1:
				return $this->reader->readInt();
			case -2:
				return $this->reader->readBool();
			case -3:
				return $this->reader->readUtf8();
			case -4:
				return $this->reader->readDouble();
			case -5:
				$id = $this->reader->readInt();
				$d2iRecord = $this->d2i_repo->findOneBy(['id' => $id]);
				return $d2iRecord != null ? $d2iRecord : null;
			case -6:
				return $this->reader->readUInt();
			case -99:
				$vectorLen = $this->reader->readInt();
				$res = [];
				for ($i = 0; $i < $vectorLen; $i++) {
					$res[] = $this->getFieldValue($field->getInnerField());
				}
				return $res;
			default:
				if ($field->getType() > 0) {
					$classId = $this->reader->readInt();
					return $this->getObjectBuilder($classId);
				}
				break;
		}
	}

	private function getClassId(int $id): int
	{
		$objectPointer = $this->objectPointerTable[$id];
		$this->reader->setPosition($objectPointer);

		return $this->reader->readInt();
	}

	public function getIndexTable(): array
	{
		return $this->objectPointerTable;
	}
}