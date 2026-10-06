<?php

namespace Newtjam\Component\Launchpad\Administrator\Extension;

use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\MVCComponent;

defined('_JEXEC') or die;

class LaunchpadComponent extends MVCComponent implements RouterServiceInterface {
	use RouterServiceTrait;
}
