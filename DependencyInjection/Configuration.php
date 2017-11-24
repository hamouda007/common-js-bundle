<?php

namespace JsSdkBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('js_sdk');

        $rootNode->normalizeKeys(false);

        $this->addGoogleAnalyticsSection($rootNode);

        $rootNode->end();
        return $treeBuilder;
    }

    private function addGoogleAnalyticsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode = $this->addSDKNode($rootNode, 'google_analytics');
        $rootNode
            ->scalarNode('id')->cannotBeEmpty()->end()
            ->booleanNode('debug')->defaultFalse()->end()
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
