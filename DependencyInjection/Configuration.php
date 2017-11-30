<?php

namespace Silverback\CommonJsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{
    /**
     * @var bool
     */
    private $debug;

    public function __construct(
        bool $debug
    )
    {
        $this->debug = $debug;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('common_js');

        $rootNode->normalizeKeys(false);

        $this->addGoogleAnalytics($rootNode);
        $this->addFacebookSdk($rootNode);
        $this->addGtm($rootNode);
        $this->addTwitter($rootNode);

        $rootNode->end();
        return $treeBuilder;
    }

    private function addGoogleAnalytics(ArrayNodeDefinition $rootNode)
    {
        $rootNode = $this->addSDKNode($rootNode, 'google_analytics');
        $rootNode
            ->scalarNode('id')->cannotBeEmpty()->defaultValue(getenv('GOOGLE_ANALYTICS_ID'))->end()
            ->scalarNode('currency')->defaultValue('GBP')->end()
            ->scalarNode('tracking_function')->defaultValue('ga')->end()
            ->booleanNode('debug')->defaultValue($this->debug)->end()
        ;
        $this->endSdkNode($rootNode);
    }

    private function addFacebookSdk(ArrayNodeDefinition $rootNode)
    {
        $rootNode = $this->addSDKNode($rootNode, 'facebook_sdk');
        $rootNode
            ->scalarNode('id')->cannotBeEmpty()->defaultValue(getenv('FACEBOOK_APP_ID'))->end()
            ->booleanNode('xfbml')->defaultTrue()->end()
            ->scalarNode('version')->cannotBeEmpty()->defaultValue('v2.11')->end()
            ->scalarNode('language')->cannotBeEmpty()->defaultValue('en_GB')->end()
            ->booleanNode('login_status_check')->defaultFalse()->end()
            ->booleanNode('debug')->defaultValue($this->debug)->end()
        ;
        $this->endSdkNode($rootNode);
    }

    private function addGtm(ArrayNodeDefinition $rootNode)
    {
        $rootNode = $this->addSDKNode($rootNode, 'gtm');
        $rootNode
            ->scalarNode('id')->cannotBeEmpty()->defaultValue(getenv('GTM_CONTAINER_ID'))->end()
            ->scalarNode('data_layer')->cannotBeEmpty()->defaultValue('dataLayer')->end()
            ->arrayNode('data')->end()
        ;
        $this->endSdkNode($rootNode);
    }

    private function addTwitter(ArrayNodeDefinition $rootNode)
    {
        $rootNode = $this->addSDKNode($rootNode, 'twitter');
        $rootNode
            ->scalarNode('script_id')->cannotBeEmpty()->defaultValue('twitter-wjs')->end()
            ->scalarNode('function_name')->cannotBeEmpty()->defaultValue('twttr')->end()
        ;
        $this->endSdkNode($rootNode);
    }

    private function addSDKNode(ArrayNodeDefinition $rootNode, $nodeName = '')
    {
        return $rootNode
            ->children()
                ->arrayNode($nodeName)
                    ->normalizeKeys(false)
                    ->canBeEnabled()
                    ->children()
                        ->arrayNode('default_blocks')
                            ->normalizeKeys(false)
                            ->useAttributeAsKey('block_name')
                            ->arrayPrototype()
                                ->normalizeKeys(false)
                                ->useAttributeAsKey('param_name')
                                ->scalarPrototype()->end()
                            ->end()
                        ->end()
        ;
    }

    private function endSdkNode(NodeBuilder $rootNode) {
        return $rootNode
                    ->end()
                ->end()
            ->end()
        ;
    }
}
