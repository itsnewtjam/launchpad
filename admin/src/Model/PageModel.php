<?php

namespace Newtjam\Component\Launchpad\Administrator\Model;

use Joomla\CMS\Application\AdministratorApplication;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class PageModel extends AdminModel {
  public function getForm($data = [], $loadData = true) {
    $form = $this->loadForm(
      'com_launchpad.page', 
      'page', 
      [
        'control' => 'jform', 
        'load_data' => $loadData
      ]
    );

    if (empty($form)) return false;

    return $form;
  }

  protected function loadFormData() {
    /** @var AdministratorApplication **/
    $app = Factory::getApplication();
    $data = $app->getUserState('com_launchpad.edit.page.data', []);

    if (empty($data)) $data = $this->getItem();

    return $data;
  }
}
