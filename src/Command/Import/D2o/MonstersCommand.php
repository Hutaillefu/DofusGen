<?php


namespace App\Command\Import\D2o;


use App\Command\Import\AbstractCommand;
use App\Logic\D2oDecoder;
use Doctrine\ORM\EntityManagerInterface;

class MonstersCommand extends AbstractCommand
{
	protected static $defaultName = "import:d2o:monsters";

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder)
	{
		parent::__construct(self::$defaultName, $em, $decoder, null);
	}

	public function mapData(int $id, array $data)
	{
		dd($data);
	}
}