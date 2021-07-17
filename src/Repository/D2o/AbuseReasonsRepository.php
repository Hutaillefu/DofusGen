<?php


namespace App\Repository\D2o;


use App\Entity\Datacenter\AbuseReasons;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class AbuseReasonsRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AbuseReasons::class);
	}
}