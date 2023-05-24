<h1><?= h($event->title) ?></h1>
<p>Date: <?= h($event->date) ?></p>
<h2>Vidéos</h2>

<ul>
    <?php foreach ($event->videos as $video): ?>
        <li>
            <?= $this->Html->link($video->title, ['controller' => 'Videos', 'action' => 'view', $video->id]) ?>
        </li>
    <?php endforeach ?>
</ul>


