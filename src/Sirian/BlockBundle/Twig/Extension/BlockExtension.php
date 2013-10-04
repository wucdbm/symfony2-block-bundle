<?php

namespace Sirian\BlockBundle\Twig\Extension;

use Sirian\BlockBundle\Block\Registry;

class BlockExtension extends \Twig_Extension
{
    protected $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function getFunctions()
    {
        return [
            'render_block' => new \Twig_SimpleFunction('render_block', [$this, 'renderBlock'], [
                'is_safe' => ['html']
            ])
        ];
    }

    public function renderBlock($block, $params = [])
    {
        return $this->registry->get($block)->execute($params);
    }

    public function getName()
    {
        return 'block';
    }
}
