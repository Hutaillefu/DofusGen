<?php


namespace App\Command;


use App\Command\Import\AbstractCommand;
use App\Entity\D2i\D2iRecord;
use App\Logic\D2iDecoder;
use App\Repository\D2iRecordRepository;
use Doctrine\ORM\EntityManagerInterface;


class ImportD2iCommand extends AbstractCommand
{
	protected static $defaultName = "import:d2i";

	function __construct(EntityManagerInterface $em, D2iDecoder $d2i, D2iRecordRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $d2i, $repo);
	}

	public function mapData(int $id, array $data): D2iRecord
	{
		return new D2iRecord($id, $data[0], isset($data[1]), $data[1] ?? null);
	}
}