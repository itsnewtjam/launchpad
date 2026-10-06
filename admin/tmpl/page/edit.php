<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

?>

<form
  action="<?= Route::_("index.php?option=com_launchpad&layout=edit&id={$this->item->id}"); ?>"
  method="post"
  name="adminForm"
  id="adminForm"
>
  <div class="row form-vertical mb-3">
    <div class="col-12 col-md-6">
      <?= $this->form->renderField('title'); ?>
    </div>
  </div>

  <div class="main-card">
    <?= HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'general']); ?>

    <?= HTMLHelper::_('uitab.addTab', 'myTab', 'general', Text::_('COM_LAUNCHPAD_PAGE_GENERAL')); ?>
      <div class="row">
        <div class="col-lg-9">
          <?= $this->form->renderField('header_image'); ?>
          <?= $this->form->renderField('heading_use_title'); ?>
          <?= $this->form->renderField('heading'); ?>
          <?= $this->form->renderField('description'); ?>
        </div>

        <div class="col-lg-3">
          <?= LayoutHelper::render('joomla.edit.global', $this); ?>
        </div>
      </div>
    <?= HTMLHelper::_('uitab.endTab'); ?>

    <?= HTMLHelper::_('uitab.addTab', 'myTab', 'design', Text::_('COM_LAUNCHPAD_PAGE_DESIGN')); ?>
      <?= $this->form->renderField('background_type'); ?>
      <?= $this->form->renderField('background_css'); ?>
      <?= $this->form->renderField('background_image'); ?>
    <?= HTMLHelper::_('uitab.endTab'); ?>

    <?= HTMLHelper::_('uitab.addTab', 'myTab', 'links', Text::_('COM_LAUNCHPAD_PAGE_LINKS')); ?>
      <?= $this->form->renderField('links'); ?>
    <?= HTMLHelper::_('uitab.endTab'); ?>

    <?= HTMLHelper::_('uitab.addTab', 'myTab', 'advanced', Text::_('COM_LAUNCHPAD_PAGE_ADVANCED')); ?>
      <?= $this->form->renderField('css'); ?>
    <?= HTMLHelper::_('uitab.endTab'); ?>

    <?= HTMLHelper::_('uitab.endTabSet'); ?>
  </div>

  <input type="hidden" name="task" value="" />
  <?= HTMLHelper::_('form.token'); ?>
</form>
