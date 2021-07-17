<?php


namespace App\Controller;


use App\Repository\D2o\Achievement\AchievementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AchievementsController
 * @package App\Controller
 * @Route("/achievements")
 */
class AchievementsController extends AbstractController
{
	/**
	 * @Route("/",name="achievement")
	 */
	public function main(AchievementsRepository $repo): Response
	{
		return $this->render('achievements.html.twig', [
			'achievements' => $repo->findAll()
		]);
	}
}