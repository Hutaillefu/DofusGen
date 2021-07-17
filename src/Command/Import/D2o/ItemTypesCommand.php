<?php


namespace App\Command\Import\D2o;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\ItemType;
use App\Logic\D2oDecoder;
use App\Repository\D2o\ItemTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ItemTypesCommand extends AbstractCommand
{
	protected static $defaultName = "import:d2o:ItemTypes";

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, ItemTypeRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): ItemType
	{
		$data = current($data);

		$itemType = new ItemType();
		$itemType->setId($data['id'])
			->setName($data['nameId'])
			->setSuperTypeId($data['superTypeId'])
			->setCategoryId($data['categoryId'])
			->setIsInEncyclopedia($data['isInEncyclopedia'])
			->setPlural($data['plural'])
			->setGender($data['gender'])
			->setRawZone($data['rawZone'])
			->setMimickable($data['mimickable'])
			->setCraftXpRatio($data['craftXpRatio'])
			->setEvolutiveTypeId($data['evolutiveTypeId']);

		return $itemType;
	}
}