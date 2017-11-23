<?php

namespace Container17Wiqxs;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class TestsEmptyDebugProjectContainer extends Container
{
    private $parameters;
    private $targetDirs = array();
    private $privates = array();

    public function __construct()
    {
        $dir = $this->targetDirs[0] = dirname(__DIR__);
        for ($i = 1; $i <= 5; ++$i) {
            $this->targetDirs[$i] = $dir = dirname($dir);
        }
        $this->parameters = $this->getDefaultParameters();

        $this->services = $this->privates = array();
        $this->syntheticIds = array(
            'kernel' => true,
        );
        $this->methodMap = array(
            'event_dispatcher' => 'getEventDispatcherService',
            'http_kernel' => 'getHttpKernelService',
            'request_stack' => 'getRequestStackService',
            'router' => 'getRouterService',
            'test.client' => 'getTest_ClientService',
        );
        $this->fileMap = array(
            'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController' => __DIR__.'/getRedirectControllerService.php',
            'Symfony\\Bundle\\FrameworkBundle\\Controller\\TemplateController' => __DIR__.'/getTemplateControllerService.php',
            'cache.app' => __DIR__.'/getCache_AppService.php',
            'cache.app_clearer' => __DIR__.'/getCache_AppClearerService.php',
            'cache.global_clearer' => __DIR__.'/getCache_GlobalClearerService.php',
            'cache.system' => __DIR__.'/getCache_SystemService.php',
            'cache.system_clearer' => __DIR__.'/getCache_SystemClearerService.php',
            'cache_clearer' => __DIR__.'/getCacheClearerService.php',
            'cache_warmer' => __DIR__.'/getCacheWarmerService.php',
            'filesystem' => __DIR__.'/getFilesystemService.php',
            'routing.loader' => __DIR__.'/getRouting_LoaderService.php',
            'serializer' => __DIR__.'/getSerializerService.php',
            'twig' => __DIR__.'/getTwigService.php',
            'twig.controller.exception' => __DIR__.'/getTwig_Controller_ExceptionService.php',
            'twig.controller.preview_error' => __DIR__.'/getTwig_Controller_PreviewErrorService.php',
        );

        $this->aliases = array();

        require_once $this->targetDirs[5].'/vendor/symfony/framework-bundle/Controller/ControllerNameParser.php';
        require_once $this->targetDirs[5].'/vendor/symfony/event-dispatcher/EventSubscriberInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/ResponseListener.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/StreamedResponseListener.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/LocaleListener.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/ValidateRequestListener.php';
        require_once $this->targetDirs[5].'/vendor/symfony/framework-bundle/EventListener/ResolveControllerNameSubscriber.php';
        require_once $this->targetDirs[5].'/vendor/symfony/event-dispatcher/EventDispatcherInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/event-dispatcher/EventDispatcher.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/HttpKernelInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/TerminableInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/HttpKernel.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Controller/ControllerResolverInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Controller/ControllerResolver.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Controller/ContainerControllerResolver.php';
        require_once $this->targetDirs[5].'/vendor/symfony/framework-bundle/Controller/ControllerResolver.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactoryInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/ControllerMetadata/ArgumentMetadataFactory.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Controller/ArgumentResolverInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Controller/ArgumentResolver.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-foundation/RequestStack.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/AbstractTestSessionListener.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/TestSessionListener.php';
        require_once $this->targetDirs[5].'/vendor/symfony/dependency-injection/ServiceLocator.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/DebugHandlersListener.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Debug/FileLinkFormatter.php';
        require_once $this->targetDirs[5].'/vendor/symfony/routing/RequestContext.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/EventListener/RouterListener.php';
        require_once $this->targetDirs[5].'/vendor/psr/log/Psr/Log/LoggerInterface.php';
        require_once $this->targetDirs[5].'/vendor/psr/log/Psr/Log/AbstractLogger.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Log/Logger.php';
        require_once $this->targetDirs[5].'/vendor/symfony/routing/RequestContextAwareInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/routing/Matcher/UrlMatcherInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/routing/Generator/UrlGeneratorInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/routing/RouterInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/routing/Matcher/RequestMatcherInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/routing/Router.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/CacheWarmer/WarmableInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/dependency-injection/ServiceSubscriberInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/framework-bundle/Routing/Router.php';
        require_once $this->targetDirs[5].'/vendor/symfony/config/ConfigCacheFactoryInterface.php';
        require_once $this->targetDirs[5].'/vendor/symfony/config/ResourceCheckerConfigCacheFactory.php';
    }

    public function reset()
    {
        $this->privates = array();
        parent::reset();
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function getRemovedIds()
    {
        return require __DIR__.'/removed-ids.php';
    }

    protected function load($file, $lazyLoad = true)
    {
        return require $file;
    }

    /**
     * Gets the public 'event_dispatcher' shared service.
     *
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\EventDispatcher();

        $instance->addListener('kernel.response', array(0 => function () {
            return ($this->privates['response_listener'] ?? $this->privates['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8'));
        }, 1 => 'onKernelResponse'), 0);
        $instance->addListener('kernel.response', array(0 => function () {
            return ($this->privates['streamed_response_listener'] ?? $this->privates['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener());
        }, 1 => 'onKernelResponse'), -1024);
        $instance->addListener('kernel.request', array(0 => function () {
            return ($this->privates['locale_listener'] ?? $this->getLocaleListenerService());
        }, 1 => 'onKernelRequest'), 16);
        $instance->addListener('kernel.finish_request', array(0 => function () {
            return ($this->privates['locale_listener'] ?? $this->getLocaleListenerService());
        }, 1 => 'onKernelFinishRequest'), 0);
        $instance->addListener('kernel.request', array(0 => function () {
            return ($this->privates['validate_request_listener'] ?? $this->privates['validate_request_listener'] = new \Symfony\Component\HttpKernel\EventListener\ValidateRequestListener());
        }, 1 => 'onKernelRequest'), 256);
        $instance->addListener('kernel.request', array(0 => function () {
            return ($this->privates['resolve_controller_name_subscriber'] ?? $this->getResolveControllerNameSubscriberService());
        }, 1 => 'onKernelRequest'), 24);
        $instance->addListener('kernel.request', array(0 => function () {
            return ($this->privates['test.session.listener'] ?? $this->getTest_Session_ListenerService());
        }, 1 => 'onKernelRequest'), 192);
        $instance->addListener('kernel.response', array(0 => function () {
            return ($this->privates['test.session.listener'] ?? $this->getTest_Session_ListenerService());
        }, 1 => 'onKernelResponse'), -128);
        $instance->addListener('kernel.request', array(0 => function () {
            return ($this->privates['debug.debug_handlers_listener'] ?? $this->getDebug_DebugHandlersListenerService());
        }, 1 => 'configure'), 2048);
        $instance->addListener('kernel.request', array(0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelRequest'), 32);
        $instance->addListener('kernel.finish_request', array(0 => function () {
            return ($this->privates['router_listener'] ?? $this->getRouterListenerService());
        }, 1 => 'onKernelFinishRequest'), 0);
        $instance->addListener('kernel.exception', array(0 => function () {
            return ($this->privates['twig.exception_listener'] ?? $this->load(__DIR__.'/getTwig_ExceptionListenerService.php'));
        }, 1 => 'onKernelException'), -128);

        return $instance;
    }

    /**
     * Gets the public 'http_kernel' shared service.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernel
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\HttpKernel(($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, ($this->privates['controller_name_converter'] ?? $this->privates['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(($this->services['kernel'] ?? $this->get('kernel')))), ($this->privates['logger'] ?? $this->privates['logger'] = new \Symfony\Component\HttpKernel\Log\Logger())), ($this->services['request_stack'] ?? $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack()), new \Symfony\Component\HttpKernel\Controller\ArgumentResolver(new \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory(), new RewindableGenerator(function () {
            yield 0 => ($this->privates['argument_resolver.request_attribute'] ?? $this->privates['argument_resolver.request_attribute'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver());
            yield 1 => ($this->privates['argument_resolver.request'] ?? $this->privates['argument_resolver.request'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver());
            yield 2 => ($this->privates['argument_resolver.session'] ?? $this->privates['argument_resolver.session'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver());
            yield 3 => ($this->privates['argument_resolver.service'] ?? $this->load(__DIR__.'/getArgumentResolver_ServiceService.php'));
            yield 4 => ($this->privates['argument_resolver.default'] ?? $this->privates['argument_resolver.default'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver());
            yield 5 => ($this->privates['argument_resolver.variadic'] ?? $this->privates['argument_resolver.variadic'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver());
        }, 6)));
    }

    /**
     * Gets the public 'request_stack' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\RequestStack
     */
    protected function getRequestStackService()
    {
        return $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack();
    }

    /**
     * Gets the public 'router' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected function getRouterService()
    {
        $this->services['router'] = $instance = new \Symfony\Bundle\FrameworkBundle\Routing\Router($this, 'kernel:loadRoutes', array('cache_dir' => $this->targetDirs[0], 'debug' => true, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'TestsEmptyDebugProjectContainerUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'TestsEmptyDebugProjectContainerUrlMatcher', 'strict_requirements' => true, 'resource_type' => 'service'), ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()));

        $instance->setConfigCacheFactory(new \Symfony\Component\Config\ResourceCheckerConfigCacheFactory(new RewindableGenerator(function () {
            yield 0 => ($this->privates['dependency_injection.config.container_parameters_resource_checker'] ?? $this->privates['dependency_injection.config.container_parameters_resource_checker'] = new \Symfony\Component\DependencyInjection\Config\ContainerParametersResourceChecker($this));
            yield 1 => ($this->privates['config.resource.self_checking_resource_checker'] ?? $this->privates['config.resource.self_checking_resource_checker'] = new \Symfony\Component\Config\Resource\SelfCheckingResourceChecker());
        }, 2)));

        return $instance;
    }

    /**
     * Gets the public 'test.client' service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function getTest_ClientService()
    {
        require_once $this->targetDirs[5].'/vendor/symfony/browser-kit/Client.php';
        require_once $this->targetDirs[5].'/vendor/symfony/http-kernel/Client.php';
        require_once $this->targetDirs[5].'/vendor/symfony/framework-bundle/Client.php';
        require_once $this->targetDirs[5].'/vendor/symfony/browser-kit/History.php';
        require_once $this->targetDirs[5].'/vendor/symfony/browser-kit/CookieJar.php';

        return new \Symfony\Bundle\FrameworkBundle\Client(($this->services['kernel'] ?? $this->get('kernel')), array(), new \Symfony\Component\BrowserKit\History(), new \Symfony\Component\BrowserKit\CookieJar());
    }

    /**
     * Gets the private 'debug.debug_handlers_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener
     */
    protected function getDebug_DebugHandlersListenerService()
    {
        return $this->privates['debug.debug_handlers_listener'] = new \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener(NULL, ($this->privates['logger'] ?? $this->privates['logger'] = new \Symfony\Component\HttpKernel\Log\Logger()), -1, -1, true, ($this->privates['debug.file_link_formatter'] ?? $this->privates['debug.file_link_formatter'] = new \Symfony\Component\HttpKernel\Debug\FileLinkFormatter(NULL)), true);
    }

    /**
     * Gets the private 'locale_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\LocaleListener
     */
    protected function getLocaleListenerService()
    {
        return $this->privates['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener(($this->services['request_stack'] ?? $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack()), 'en', ($this->services['router'] ?? $this->getRouterService()));
    }

    /**
     * Gets the private 'resolve_controller_name_subscriber' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\EventListener\ResolveControllerNameSubscriber
     */
    protected function getResolveControllerNameSubscriberService()
    {
        return $this->privates['resolve_controller_name_subscriber'] = new \Symfony\Bundle\FrameworkBundle\EventListener\ResolveControllerNameSubscriber(($this->privates['controller_name_converter'] ?? $this->privates['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(($this->services['kernel'] ?? $this->get('kernel')))));
    }

    /**
     * Gets the private 'router.request_context' shared service.
     *
     * @return \Symfony\Component\Routing\RequestContext
     */
    protected function getRouter_RequestContextService()
    {
        return $this->privates['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }

    /**
     * Gets the private 'router_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\RouterListener
     */
    protected function getRouterListenerService()
    {
        return $this->privates['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener(($this->services['router'] ?? $this->getRouterService()), ($this->services['request_stack'] ?? $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack()), ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()), ($this->privates['logger'] ?? $this->privates['logger'] = new \Symfony\Component\HttpKernel\Log\Logger()), $this->targetDirs[3], true);
    }

    /**
     * Gets the private 'test.session.listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\TestSessionListener
     */
    protected function getTest_Session_ListenerService()
    {
        return $this->privates['test.session.listener'] = new \Symfony\Component\HttpKernel\EventListener\TestSessionListener(new \Symfony\Component\DependencyInjection\ServiceLocator(array()));
    }

    public function getParameter($name)
    {
        $name = (string) $name;

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name)
    {
        $name = (string) $name;

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters);
    }

    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = array(
        'kernel.root_dir' => false,
        'kernel.project_dir' => false,
        'kernel.cache_dir' => false,
        'kernel.logs_dir' => false,
        'kernel.bundles_metadata' => false,
        'debug.container.dump' => false,
        'serializer.mapping.cache.file' => false,
        'twig.default_path' => false,
    );
    private $dynamicParameters = array();

    /**
     * Computes a dynamic parameter.
     *
     * @param string The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        switch ($name) {
            case 'kernel.root_dir': $value = $this->targetDirs[4]; break;
            case 'kernel.project_dir': $value = $this->targetDirs[3]; break;
            case 'kernel.cache_dir': $value = $this->targetDirs[0]; break;
            case 'kernel.logs_dir': $value = ($this->targetDirs[2].'/log'); break;
            case 'kernel.bundles_metadata': $value = array(
                'FrameworkBundle' => array(
                    'path' => ($this->targetDirs[5].'/vendor/symfony/framework-bundle'),
                    'namespace' => 'Symfony\\Bundle\\FrameworkBundle',
                ),
                'TwigBundle' => array(
                    'path' => ($this->targetDirs[5].'/vendor/symfony/twig-bundle'),
                    'namespace' => 'Symfony\\Bundle\\TwigBundle',
                ),
                'JsSdkBundle' => array(
                    'path' => $this->targetDirs[5],
                    'namespace' => 'JsSdkBundle',
                ),
            ); break;
            case 'debug.container.dump': $value = ($this->targetDirs[0].'/TestsEmptyDebugProjectContainer.xml'); break;
            case 'serializer.mapping.cache.file': $value = ($this->targetDirs[0].'/serialization.php'); break;
            case 'twig.default_path': $value = ($this->targetDirs[3].'/templates'); break;
            default: throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
        }
        $this->loadedDynamicParameters[$name] = true;

        return $this->dynamicParameters[$name] = $value;
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'kernel.environment' => 'empty',
            'kernel.debug' => true,
            'kernel.name' => 'Tests',
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'JsSdkBundle' => 'JsSdkBundle\\JsSdkBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'TestsEmptyDebugProjectContainer',
            'container.autowiring.strict_mode' => true,
            'container.dumper.inline_class_loader' => true,
            'kernel.secret' => 'test',
            'fragment.renderer.hinclude.global_template' => '',
            'fragment.path' => '/_fragment',
            'kernel.http_method_override' => true,
            'kernel.trusted_hosts' => array(

            ),
            'kernel.default_locale' => 'en',
            'templating.helper.code.file_link_format' => NULL,
            'debug.file_link_format' => NULL,
            'test.client.parameters' => array(

            ),
            'data_collector.templates' => array(

            ),
            'debug.error_handler.throw_at' => -1,
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => 'kernel:loadRoutes',
            'router.cache_class_prefix' => 'TestsEmptyDebugProjectContainer',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'serializer.mapping.cache.prefix' => '',
            'twig.exception_listener.controller' => 'twig.controller.exception:showAction',
            'twig.form.resources' => array(
                0 => 'form_div_layout.html.twig',
            ),
        );
    }
}
