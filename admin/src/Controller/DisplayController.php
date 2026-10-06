<?php

namespace Newtjam\Component\Launchpad\Administrator\Controller;

use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

class DisplayController extends BaseController {
  protected $default_view = 'pages';

  public function display($cachable = false, $urlparams = []) {
    return parent::display($cachable, $urlparams);
  }
}
