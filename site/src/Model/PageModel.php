<?php

namespace Newtjam\Component\Launchpad\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ItemModel;

defined('_JEXEC') or die;

class PageModel extends ItemModel {
  public function getItem($pk = null) {
    $app = Factory::getApplication();
    $input = $app->getInput();
    $id = $input->get('id', 0, 'INT');

    $table = $this->getTable('Page', 'Administrator');
    $result = $table->load($id);
    if (!$result || $table->published != 1) throw new \UnexpectedValueException('id out of range');

    $table->links = json_decode($table->links) ?? [];

    return $table;
  }
}
