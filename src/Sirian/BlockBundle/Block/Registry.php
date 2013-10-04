<?php

namespace Sirian\BlockBundle\Block;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Registry
{
    protected $blockServices = [];
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addBlockService($name, $service)
    {
        $this->blockServices[$name] = $service;
    }

    /**
     * @param $name
     * @return BlockInterface
     * @throws \InvalidArgumentException
     */
    public function get($name)
    {
        if (!isset($this->blockServices[$name])) {
            throw new \InvalidArgumentException(sprintf('Block "%s" not found', $name));
        }

        return $this->container->get($this->blockServices[$name]);
    }
}
