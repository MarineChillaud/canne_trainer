<h1>Bienvenue sur CanneTrainer</h1>

<h1>Vidéos</h1>
<table>
    <tr>
        <th>Titre</th>
        <th>Compétition</th>
        <th>Date</th>
    </tr>

<?php foreach($videos as $video): ?>
    <tr>
        <td><?= $this->Html->link($video->title, ['controller' => 'Videos', 'action' => 'view', $video->id]) ?></td>            
        <td><?= h($video->event->title) ?></td>
        <td><?= h($video->date) ?></td>
        </tr>
    
<?php endforeach ?>

</table>

