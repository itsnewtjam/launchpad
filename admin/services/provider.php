<?php

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Newtjam\Component\Launchpad\Administrator\Extension\LaunchpadComponent;

return new class implements ServiceProviderInterface {
	public function register(Container $container) {
		$container->registerServiceProvider(new MVCFactory('\\Newtjam\\Component\\Launchpad'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\Newtjam\\Component\\Launchpad'));
    $container->registerServiceProvider(new RouterFactory('\\Newtjam\\Component\\Launchpad'));

    $container->set(
      ComponentInterface::class,
      function (Container $container) {
        $component = new LaunchpadComponent($container->get(ComponentDispatcherFactoryInterface::class));
        $component->setMVCFactory($container->get(MVCFactoryInterface::class));
        $component->setRouterFactory($container->get(RouterFactoryInterface::class));

        return $component;
      }
    );
	}
};
