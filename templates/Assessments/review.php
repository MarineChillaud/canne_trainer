<?php
pr($assessments->toArray());

$this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
)) ?>

<!-- Ajout du bloc pour les messages flash -->
<div class="row">
    <div class="col">
        <?= $this->Flash->render() ?>
    </div>
</div>

<?php foreach ($videos as $video) : ?>
    <h1><?= h($video->title) ?></h1>
<?php endforeach ?>
