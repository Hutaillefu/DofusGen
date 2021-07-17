<?php


namespace App\Controller;


use App\Entity\D2i\D2iRecord;
use App\Entity\FileVersion;
use App\Logic\D2iDecoder;
use App\Logic\D2oDecoder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

class MainController extends AbstractController
{
	/**
	 * @Route("/", name="main")
	 */
	public function main(D2oDecoder $d2o, D2iDecoder $d2i, EntityManagerInterface $em): Response
	{
//		$d2o->process("/home/sayl/Documents/ItemTypes.d2o");
//		$d2o->begin("/home/sayl/Documents/ItemTypes.d2o");
//		$d2o->initIndexTable();
//		$d2o->end();
//		dump('ok');
//		$d2i->process("/home/sayl/Documents/i18n_fr.d2i");

		$this->readMeta();
		return $this->render('main.html.twig');
	}

	/**
	 * @Route("/import/d2i", name="import_d2i")
	 */
	public function import_d2i(): Response
	{
		$process = new Process(['php', 'bin/console', 'import:d2o:item_types', "/home/sayl/Documents/ItemTypes.d2o"], "/var/www/html/DofusGen");
		$process->run();

		dump($process->getOutput());

		return $this->render('main.html.twig');
	}

	public function readMeta(): array
	{
		$filename = "/home/sayl/Documents/data.meta";
		$read = new Serializer([], [new XmlEncoder()]);
		$res = $read->decode(file_get_contents($filename), 'xml');

		$res = $res['filesVersions']['file'];

		$versions = [];

		foreach ($res as $entry) {
			$versions[] = new FileVersion($entry["@name"], $entry['#']);
		}

		dump($versions);
		return $versions;
	}


}