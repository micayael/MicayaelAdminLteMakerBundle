<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function __invoke(EntityManagerInterface $em)
    {
        return $this->render('public/index.html.twig');
    }
}
