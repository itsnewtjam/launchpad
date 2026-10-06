<?php

namespace Newtjam\Component\Launchpad\Site\Controller;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

class DisplayController extends BaseController {
  public function display($cachable = false, $urlparams = []) {
    /** @var HtmlView **/
    $view = $this->getView('page', 'html');
    $model = $this->getModel('page');
    $view->setModel($model, true);
    $view->display();
  }
}
