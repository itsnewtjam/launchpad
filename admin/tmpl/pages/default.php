<?php

use Joomla\CMS\Button\PublishedButton;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));

?>

<form
  action="<?= Route::_('index.php?option=com_launchpad&view=pages'); ?>"
  method="post"
  name="adminForm"
  id="adminForm"
>
  <?= LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

  <?php if (empty($this->items)) : ?>
  <div class="alert alert-info">
    <span class="icon-info-circle" aria-hidden="true"></span>
    <span class="visually-hidden"><?= Text::_('INFO'); ?></span>
    <?= Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
  </div>
  <?php else : ?>
  <table class="table">
    <caption class="visually-hidden">
      <?= Text::_('COM_LAUNCHPAD_PAGES_CAPTION'); ?>
    </caption>
    <thead>
      <tr>
        <td class="w-1 text-center">
          <?= HTMLHelper::_('grid.checkall'); ?>
        </td>
        <th scope="col" class="w-1 text-center">
          <?= Text::_('JSTATUS'); ?>
        </th>
        <th scope="col">
          <?= HTMLHelper::_('searchtools.sort', 'COM_LAUNCHPAD_PAGE_TITLE', 'title', $listDirn, $listOrder); ?>
        </th>
        <th scope="col" class="w-1">
          <?= HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'id', $listDirn, $listOrder); ?>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($this->items as $i => $item) : ?>
      <tr>
        <td class="text-center">
          <?= HTMLHelper::_('grid.id', $i, $item->id, false, 'cid', 'cb', $item->title); ?>
        </td>
        <td class="text-center">
          <?= (new PublishedButton())->render($item->published, $i, [
            'task_prefix' => 'pages.',
            'id' => "published-{$item->id}"],
          ); ?>
        </td>
        <th scope="row">
          <a href="<?= Route::_("index.php?option=com_launchpad&task=page.edit&id={$item->id}"); ?>">
            <?= $this->escape($item->title); ?>
          </a>
        </th>
        <td>
          <?= $item->id; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

  <?= $this->pagination->getListFooter(); ?>
  
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <?= HTMLHelper::_('form.token'); ?>
</form>
