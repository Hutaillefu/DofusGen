<?php


namespace App\Repository\D2o;


use App\Entity\Datacenter\ItemType;
use App\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class ItemTypeRepository extends AbstractRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, ItemType::class);
	}
}