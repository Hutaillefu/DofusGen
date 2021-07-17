<?php


namespace App\Entity\Datacenter;


use Doctrine\ORM\Mapping as ORM;
use App\Entity\D2i\D2iRecord;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\D2o\AbuseReasonsRepository;

/**
 * @Entity(repositoryClass=AbuseReasonsRepository::class)
 */
class AbuseReasons
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id()
	 */
	private $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $mask;

	/**
	 * @ORM\OneToOne(targetEntity=D2iRecord::class)
	 */
	private $reasonText;

	public function __construct(int $id, int $mask, D2iRecord $reasonText)
	{
		$this->id = $id;
		$this->mask = $mask;
		$this->reasonText = $reasonText;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getMask(): int
	{
		return $this->mask;
	}

	public function getReasonText(): D2iRecord
	{
		return $this->reasonText;
	}


}