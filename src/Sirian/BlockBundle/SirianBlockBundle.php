<?php

namespace Sirian\BlockBundle;

use Sirian\BlockBundle\DependencyInjection\Compiler\BlockConfigurationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SirianBlockBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new BlockConfigurationPass());
    }
}
