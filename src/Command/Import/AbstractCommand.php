<?php


namespace App\Command\Import;


use App\Logic\IDecoder;
use App\Repository\AbstractRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
	private $decoder;
	private $repo;
	private $em;

	public function __construct(string $name, EntityManagerInterface $em, IDecoder $decoder, AbstractRepository $repo = null)
	{
		$this->em = $em;
		$this->decoder = $decoder;
		$this->repo = $repo;
		parent::__construct($name);
	}

	/**
	 * Chaque commande nécessite en paramètre un fichier de données provenant du client Dofus
	 */
	protected function configure()
	{
		$this->addArgument('d2_file', InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		try {
			if ($this->repo != null)
				$this->repo->clearAllEntity();

			$this->decoder->begin($input->getArgument('d2_file'));
			$this->decoder->initIndexTable();
			$i = 0;

			$progressBar = new ProgressBar($output, count($this->decoder->getIndexTable()));
			$progressBar->start();

			foreach ($this->decoder->getIndexTable() as $id => $info) {

				$data = $this->decoder->searchById($id);
				$entity = $this->mapData($id, $data);
				$i++;

				$this->em->persist($entity);
				unset($entity);
				$progressBar->advance();

				if ($i % 1000 == 0) {
					$this->em->flush();
					$this->em->clear();
				}
			}

			$this->em->flush();
			$this->decoder->end();

			$progressBar->finish();
			$output->writeln("\n$i entities added");
		} catch (\Exception $e) {
			$output->writeln($e->getMessage());
			return self::FAILURE;
		}

		return self::SUCCESS;
	}

	public abstract function mapData(int $id, array $data);
}