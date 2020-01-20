<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __invoke(EntityManagerInterface $em)
    {
//        $sql = 'select count(1) from vehiculo';
//        $vehiculos = $em->getConnection()->query($sql)->fetchColumn();
//
//        $sql = "select count(1) from usuario where tipo_usuario = 'Administrador'";
//        $administradores = $em->getConnection()->query($sql)->fetchColumn();
//
//        $sql = "select count(1) from usuario where tipo_usuario = 'Usuario'";
//        $usuarios = $em->getConnection()->query($sql)->fetchColumn();
//
        return $this->render('admin/home.html.twig', [
//            'vehiculos' => $vehiculos,
//            'administradores' => $administradores,
//            'usuarios' => $usuarios,
        ]);
    }
}
