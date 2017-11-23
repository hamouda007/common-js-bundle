<?php

namespace JsSdkBundle\Providers;

final class GoogleAnalyticsProvider extends BaseProvider
{
    public function getTwigArgs(array $twigArgs = null)
    {
        return [
            'id' => ''
        ];
    }
}
