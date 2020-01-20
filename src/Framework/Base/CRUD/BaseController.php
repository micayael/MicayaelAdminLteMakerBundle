<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base\CRUD;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected function throw404IfNotFound($objectOrArray)
    {
        if (!$objectOrArray || empty($objectOrArray)) {
            throw $this->createNotFoundException();
        }
    }

    /**
     * Agrega un mensaje flash de tipo success.
     *
     * @param $message
     */
    protected function addSuccessMessage($message): void
    {
        $this->addFlash('success', $message);
    }

    /**
     * Agrega un mensaje flash de tipo warning.
     *
     * @param $message
     */
    protected function addWarningMessage($message): void
    {
        $this->addFlash('warning', $message);
    }

    /**
     * Agrega un mensaje flash de tipo danger.
     *
     * @param $message
     */
    protected function addDangerMessage($message): void
    {
        $this->addFlash('danger', $message);
    }

    /**
     * Agrega un mensaje flash de tipo info.
     *
     * @param $message
     */
    protected function addInfoMessage($message): void
    {
        $this->addFlash('info', $message);
    }
}
