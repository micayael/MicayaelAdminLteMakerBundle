<?php

namespace Micayael\AdminLteMakerBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class MicayaelAdminLteMakerCrudEvent extends Event
{
    private $subject;

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }
}
