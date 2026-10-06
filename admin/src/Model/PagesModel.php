<?php

namespace Newtjam\Component\Launchpad\Administrator\Model;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;

defined('_JEXEC') or die;

class PagesModel extends ListModel {
  public function __construct($config = [], ?MVCFactoryInterface $factory = null) {
    if (empty($config['filter_fields'])) {
      $config['filter_fields'] = [
        'id',
        'title',
        'published',
      ];
    }

    parent::__construct($config, $factory);
  }

  protected function getListQuery() {
    $db = $this->getDatabase();
    $query = $db->createQuery()
      ->select('*')
      ->from($db->quoteName('#__launchpad_pages'));

    $search = $this->getState('filter.search');
    if (!empty($search)) {
      $search = '%' . str_replace(' ', '%', trim($search)) . '%';
      $query
        ->where("{$db->quoteName('title')} LIKE :search")
        ->bind(':search', $search);
    }

    $published = (string) $this->getState('filter.published');
    if ($published !== '*') {
      if (is_numeric($published)) {
        $state = (int) $published;
        $query
          ->where("{$db->quoteName('published')} = :state")
          ->bind(':state', $state, ParameterType::INTEGER);
      } else {
        $query->whereIn($db->quoteName('published'), [0, 1]);
      }
    }

    $orderCol = $this->state->get('list.ordering', 'id');
    $orderDirn = $this->state->get('list.direction', 'ASC');
    $query->order("{$db->escape($orderCol)} {$db->escape($orderDirn)}");

    return $query;
  }

  protected function populateState($ordering = 'id', $direction = 'asc') {
    parent::populateState($ordering, $direction);
  }
}
