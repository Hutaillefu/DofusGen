<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FileVersionRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Référence le hash actuel d'un fichier Dofus
 * @ORM\Entity(repositoryClass=FileVersionRepository::class)
 */
class FileVersion
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * Nom du fichier.d2o
	 * @ORM\Column(type="string")
	 */
	private $filename;

	/**
	 * Hash du fichier
	 * @ORM\Column(type="string")
	 */
	private $hash;

	/**
	 * Date de dernière mise à jour du hash
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $updated;

	/**
	 * @ORM\OneToMany(targetEntity=GameDataClassDefinition::class, mappedBy="fileVersion", cascade={"persist"})
	 */
	private $gameDataClassDefinitions;

	private $canUpdate;

	public function __construct(string $filename, string $hash)
	{
		$this->filename = $filename;
		$this->hash = $hash;
		$this->gameDataClassDefinitions = new ArrayCollection();
	}


	public function getFilename(): string
	{
		return $this->filename;
	}

	public function getHash(): string
	{
		return $this->hash;
	}

	public function getUpdated(): ?\DateTime
	{
		return $this->updated;
	}

	public function setHash(string $hash): void
	{
		$this->hash = $hash;
	}

	public function setUpdated(\DateTime $updated): void
	{
		$this->updated = $updated;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setCanUpdate(KernelInterface $kernel, ParameterBagInterface $params, Finder $finder)
	{
		$commandFilename = explode('.', $this->filename)[0] . 'Command.php';

		$finder->files()->in($kernel->getProjectDir() . '/src/Command/Import/D2o/')->name($commandFilename);

		$filePath = $params->get('dofus_folder') . $this->filename;

		$this->canUpdate = $finder->hasResults() && file_exists($filePath);
	}

	public function getCanUpdate(): bool
	{
		return $this->canUpdate;
	}

	public function getGameDataClassDefinitions(): Collection
	{
		return $this->gameDataClassDefinitions;
	}

	public function addGameDataClassDefinitions(GameDataClassDefinition $gameDataClassDefinition): self
	{
		$this->gameDataClassDefinitions[] = $gameDataClassDefinition;
		$gameDataClassDefinition->setFileVersion($this);
		return $this;
	}


}