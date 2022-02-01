<?php
if($id) {?>
  <div id="piano-key-modal-cnt" class="piano-key-modal hidden" data-active-card="<?= $id ?>" data-component="piano-key-modal">
    <?= get_component('piano-key-modal-content', ['id' => $id]) ?>
  </div><?php
}