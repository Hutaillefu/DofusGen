<?php


namespace App\Entity\D2i;

use App\Repository\D2iRecordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class D2iRecord
 * @package App\Entity\D2i
 * @ORM\Entity(repositoryClass=D2iRecordRepository::class)
 */
class D2iRecord
{
	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="text", nullable=false)
	 */
	private $value;

	/**
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	private $hasDiacritical;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $valueDiacritical;

	public function __construct(int $id, string $value, bool $hasDiacritical, string $valueDiacritical = null)
	{
		$this->id = $id;
		$this->value = $value;
		$this->hasDiacritical = $hasDiacritical;
		$this->valueDiacritical = $valueDiacritical;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getValue(): string
	{
		return $this->value;
	}

	public function isHasDiacritical(): bool
	{
		return $this->hasDiacritical;
	}

	public function getValueDiacritical(): ?string
	{
		return $this->valueDiacritical;
	}


}