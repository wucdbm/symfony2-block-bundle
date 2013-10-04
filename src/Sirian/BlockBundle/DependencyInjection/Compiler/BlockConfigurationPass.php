<?php

namespace Sirian\BlockBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class BlockConfigurationPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $suggester = $container->getDefinition('sirian_block.registry');

        foreach ($container->findTaggedServiceIds('sirian_block') as $id => $attributes) {
            foreach ($attributes as $attr) {
                if (!isset($attr['alias'])) {
                    throw new \InvalidArgumentException(sprintf('Block "%s" must specify "alias" attribute', $id));
                }

                $definition = $container->getDefinition($id);
                $reflectionClass = new \ReflectionClass($definition->getClass());
                if ($reflectionClass->isSubclassOf('Symfony\Component\DependencyInjection\ContainerAwareInterface')) {
                    $definition->addMethodCall('setContainer', [new Reference('service_container')]);
                }

                $suggester->addMethodCall('addBlockService', [$attr['alias'], $id]);
            }
        }
    }
}
