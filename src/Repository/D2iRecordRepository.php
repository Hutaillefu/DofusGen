<?php


namespace App\Repository;


use App\Entity\D2i\D2iRecord;
use Doctrine\Persistence\ManagerRegistry;

class D2iRecordRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, D2iRecord::class);
	}

	/**
	 * Remove each D2iRecord
	 */
	public function clearAllEntity()
	{
		$this->createQueryBuilder('d')
			->delete()
			->getQuery()
			->getResult();
	}
}