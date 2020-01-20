<?php

namespace App\Security;

use App\Entity\Usuario;
use FOS\UserBundle\Security\UserProvider;

class CustomUserProvider extends UserProvider
{
    protected function findUser($username)
    {
        /**
         * @var $user Usuario
         */
        $user = $this->userManager->findUserByUsernameOrEmail($username);

//        if ($user && $user->isTipoUsuario() && false === $user->isSuscripcionActiva()) {
//            $user->setEnabled(false);
//        }

        return $user;
    }
}
