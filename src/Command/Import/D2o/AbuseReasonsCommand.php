<?php


namespace App\Command\Import\D2o;


use App\Command\Import\AbstractCommand;
use App\Entity\Datacenter\AbuseReasons;
use App\Logic\D2oDecoder;
use App\Repository\D2o\AbuseReasonsRepository;
use Doctrine\ORM\EntityManagerInterface;

class AbuseReasonsCommand extends AbstractCommand
{
	protected static $defaultName = 'import:d2o:AbuseReasons';

	public function __construct(EntityManagerInterface $em, D2oDecoder $decoder, AbuseReasonsRepository $repo)
	{
		parent::__construct(self::$defaultName, $em, $decoder, $repo);
	}

	public function mapData(int $id, array $data): AbuseReasons
	{
		$data = current($data);
		return new AbuseReasons($data['_abuseReasonId'], $data['_mask'], $data['_reasonTextId']);
	}
}