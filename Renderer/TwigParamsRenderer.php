<?php

namespace JsSdkBundle\Renderer;

use JsSdkBundle\Model\TwigParams;

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
            throw new \Twig_Error_Runtime('One of the js_sdk blocks you are trying to include has not been fully configured and is missing an option. For `'.$twigParams->getSdk().'`: ' . $e->getMessage());
        }
    }
}
