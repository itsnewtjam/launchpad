<?php

namespace Newtjam\Component\Launchpad\Administrator\Controller;

use Joomla\CMS\MVC\Controller\AdminController;

defined('_JEXEC') or die;

class PagesController extends AdminController {
  public function getModel($name = 'Page', $prefix = 'Administrator', $config = ['ignore_request' => true]) {
    return parent::getModel($name, $prefix, $config);
  }
}
