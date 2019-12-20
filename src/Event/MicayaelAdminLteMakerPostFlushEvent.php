<?php

namespace Micayael\AdminLteMakerBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class MicayaelAdminLteMakerPostFlushEvent extends Event
{
    private $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }
}
