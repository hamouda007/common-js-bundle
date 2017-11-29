<?php

namespace CommonJsBundle\Renderer;

use CommonJsBundle\Model\TwigParams;

class TwigParamsRenderer
{
    /**
     * @var \Twig_Environment
     */
    private static $twig;

    public static function setTwigEnvironment(\Twig_Environment $twig)
    {
        self::$twig = $twig;
    }

    public function render(TwigParams $twigParams): string
    {
        try {
            return self::$twig->render($twigParams->getPath(), $twigParams->getArguments());
        } catch(\Twig_Error_Runtime $e) {
            throw new \Twig_Error_Runtime('One of the common_js blocks you are trying to include has not been fully configured and is missing a parameter for `'.$twigParams->getName().'`: ' . $e->getMessage());
        }
    }
}
