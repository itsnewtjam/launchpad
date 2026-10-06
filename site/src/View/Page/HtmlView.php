<?php

namespace Newtjam\Component\Launchpad\Site\View\Page;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Newtjam\Component\Launchpad\Site\Model\PageModel;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView {
  public function display($tpl = null) {
    /** @var PageModel **/
    $model = $this->getModel();
    $this->data = $model->getItem();

    Factory::getApplication()->getInput()->set('tmpl', 'component');

    $this->loadTemplateHeader();

    parent::display($tpl);
  }

  public function loadTemplateHeader() {
    /** @var SiteApplication **/
    $app = Factory::getApplication();
    $wa = $app->getDocument()->getWebAssetManager();

    $wa->useStyle("com_launchpad.style");

    if (!empty($this->data->css)) {
      $wa->addInlineStyle($this->data->css);
    }
  }
}
