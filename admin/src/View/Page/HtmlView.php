<?php

namespace Newtjam\Component\Launchpad\Administrator\View\Page;

use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Newtjam\Component\Launchpad\Administrator\Model\PageModel;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView {
  public function display($tpl = null) {
    /** @var PageModel */
    $model = $this->getModel();
    $this->form = $model->getForm();
    $this->item = $model->getItem();

    $this->addToolbar();

    parent::display($tpl);
  }

  protected function addToolbar() {
    Factory::getApplication()->getInput()->set('hidemainmenu', true);

    ToolbarHelper::title(Text::_('COM_LAUNCHPAD_PAGE'), 'edit');
    ToolbarHelper::apply('page.apply', 'JTOOLBAR_APPLY');

    /** @var HtmlDocument **/
    $doc = $this->getDocument();
    $toolbar = $doc->getToolbar();
    $dropdown = $toolbar->dropdownButton('save-group');
    $childBar = $dropdown->getChildToolbar();
    $childBar->save('page.save');
    $childBar->save2new('page.save2new');
    $childBar->save2copy('page.save2copy');
    ToolbarHelper::cancel('page.cancel', 'JTOOLBAR_CLOSE');
  }
}
