<?php

namespace Newtjam\Component\Launchpad\Administrator\View\Pages;

use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Newtjam\Component\Launchpad\Administrator\Model\PagesModel;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView {
  public function display($tpl = null) {
    /** @var PagesModel **/
    $model = $this->getModel();
    $this->items = $model->getItems();
    $this->filterForm = $model->getFilterForm();
    $this->activeFilters = $model->getActiveFilters();
    $this->pagination = $model->getPagination();
    $this->state = $model->getState();

    $this->addToolbar();

    parent::display($tpl);
  }

  protected function addToolbar() {
    ToolbarHelper::title(Text::_('COM_LAUNCHPAD_PAGES'), 'none fa fa-rocket');
    ToolbarHelper::addNew('page.add', 'JTOOLBAR_NEW');

    /** @var HtmlDocument **/
    $doc = $this->getDocument();
    $toolbar = $doc->getToolbar();
    $dropdown = $toolbar->dropdownButton('status-group')
      ->text('JTOOLBAR_CHANGE_STATUS')
      ->toggleSplit(false)
      ->icon('icon-ellipsis-h')
      ->buttonClass('btn btn-action')
      ->listCheck(true);
    $childBar = $dropdown->getChildToolbar();
    $childBar->publish('pages.publish')->listCheck(true);
    $childBar->unpublish('pages.unpublish')->listCheck(true);
    if ($this->state->get('filter.published') != -2) {
      $childBar->trash('pages.trash')->listCheck(true);
    } else {
      $childBar->delete('pages.delete', 'JTOOLBAR_DELETE_FROM_TRASH')
        ->message('JGLOBAL_CONFIRM_DELETE')
        ->icon('fa fa-circle-xmark')
        ->listCheck(true);
    }
  }
}
