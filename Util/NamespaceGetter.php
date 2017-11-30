<?php

namespace Silverback\CommonJsBundle\Util;

use Silverback\CommonJsBundle\Model\TwigParams;
use Silverback\CommonJsBundle\Provider\Js\GoogleAnalyticsProvider;
use Silverback\CommonJsBundle\SilverbackCommonJsBundle;

final class NamespaceGetter
{
    public static function getModelNamespace()
    {
        return self::getNamespaceFromClassName(TwigParams::class);
    }

    public static function getProviderNamespace()
    {
        return self::getNamespaceFromClassName(GoogleAnalyticsProvider::class);
    }

    public static function getTwigNamespace()
    {
        $parts = explode('\\', preg_replace('/Bundle$/', '', SilverbackCommonJsBundle::class));
        return '@' . array_pop($parts);
    }

    private static function getNamespaceFromClassName(string $className)
    {
        $classParts = explode('\\', $className);
        array_pop($classParts);
        return join('\\', $classParts) . '\\';
    }
}
