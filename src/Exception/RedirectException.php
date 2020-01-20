<?php

namespace Micayael\AdminLteMakerBundle\Exception;

class RedirectException extends AdminLteMakerBundleException
{
    private $route;

    private $routeParams;

    private $messageType;

    /**
     * RedirectException constructor.
     */
    public function __construct(?string $message, string $route, array $routeParams = [], string $messageType = 'warning')
    {
        parent::__construct($message, 0, null);

        $this->route = $route;
        $this->routeParams = $routeParams;
        $this->messageType = $messageType;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getRouteParams(): array
    {
        return $this->routeParams;
    }

    public function getMessageType(): string
    {
        return $this->messageType;
    }
}
