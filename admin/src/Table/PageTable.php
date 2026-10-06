<?php

namespace Newtjam\Component\Launchpad\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseInterface;

class PageTable extends Table {
  protected $_jsonEncode = ['links'];

  public function __construct(DatabaseInterface $db) {
    parent::__construct('#__launchpad_pages', 'id', $db);
  }
}
