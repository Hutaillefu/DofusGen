<?php


namespace App\Controller;


use App\Entity\FileVersion;
use App\Repository\D2o\Achievement\AchievementsRepository;
use App\Repository\FileVersionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/meta")
 */
class MetaController extends AbstractController
{
	private $params;
	private $repo;
	private $em;

	public function __construct(ParameterBagInterface $params, FileVersionRepository $repo, EntityManagerInterface $em)
	{
		$this->params = $params;
		$this->repo = $repo;
		$this->em = $em;
	}

	/**
	 * @Route("/", name="meta")
	 */
	public function meta(KernelInterface $kernel, ParameterBagInterface $params, AchievementsRepository $repo): Response
	{
		$filesVersion = $this->repo->findAll();

		dump('ok');

		foreach ($filesVersion as $fileVersion) {
			$fileVersion->setCanUpdate($kernel, $params, new Finder());
		}

		return $this->render('metas.html.twig', [
			'filesVersion' => $filesVersion
		]);
	}

	/**
	 * @Route("/update/{id}" , name="update_meta")
	 */
	public function update_meta(FileVersion $fileVersion, KernelInterface $kernel, ParameterBagInterface $params, EntityManagerInterface $em)
	{
		$commandName = explode('.', $fileVersion->getFilename())[0];
		$process = new Process(['php', 'bin/console', 'import:d2o:' . $commandName, $params->get('dofus_folder') . $fileVersion->getFilename()],
			$kernel->getProjectDir());

		$process->run();

		if ($process->getExitCode() == 0) {
			$fileVersion->setUpdated(new \DateTime('now'));
			$em->persist($fileVersion);
			$em->flush();
		}

		dd($process->getOutput());
	}

	/**
	 * @Route("/import", name="import_metas")
	 */
	public function importMetas()
	{
		$filesVersion = $this->readMeta();

		foreach ($filesVersion as $fileVersion) {
			if ($this->repo->findOneBy(['filename' => $fileVersion->getFilename()]) == null)
				$this->em->persist($fileVersion);
		}
		$this->em->flush();

		return $this->redirectToRoute('meta');
	}

	private function readMeta(): array
	{
		$filename = $this->params->get('dofus_folder') . "data.meta";
		$read = new Serializer([], [new XmlEncoder()]);

		$res = $read->decode(file_get_contents($filename), 'xml');
		$res = $res['filesVersions']['file'];

		$versions = [];
		foreach ($res as $entry) {
			$versions[] = new FileVersion($entry["@name"], $entry['#']);
		}

		return $versions;
	}
}