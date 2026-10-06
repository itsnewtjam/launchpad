<?php

defined('_JEXEC') or die;

if ($this->data->background_type === 'image') {
  $bg = "url('{$this->data->background_image}')";
} else {
  $bg = $this->data->background_css;
}

$heading = $this->data->heading;
if ($this->data->heading_use_title == 1) {
  $heading = $this->data->title;
}
?>

<main
  class="launchpad"
  style="background: <?= $bg; ?>"
>
  <div class="launchpad-content">
    <header class="launchpad-head">
      <?php if ($this->data->header_image) : ?>
        <img
          class="launchpad-image"
          src="<?= $this->data->header_image; ?>"
          alt=""
        />
      <?php endif; ?>
      <h1 class="launchpad-title">
        <?= $this->escape($heading); ?>
      </h1>
      <div class="launchpad-desc">
        <?= $this->data->description; ?>
      </div>
    </header>

    <ul class="launchpad-items">
      <?php foreach ($this->data->links as $link) : ?>
        <li class="launchpad-item">
          <a
            class="launchpad-link"
            href="<?= $link->url; ?>"
            <?php if ($link->new_tab == 1) echo 'target="_blank"'; ?>
          >
            <?= $this->escape($link->text); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</main>
