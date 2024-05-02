<div container>
    <div class="col-md-12 text-left">
        <h1>Mes évaluations</h1>
    </div>

</div>
<div class="col-md-12 text-center">
    <table class="table table-dark table-hover table-striped">
        <tr class="text-white">
            <th>Rencontre</th>
            <th>Compétition</th>
            <th>Mes évaluations</th>
            <th>Toutes les évaluations </th>
        </tr>

        <?php foreach ($videos as $video) : ?>
            <tr class="text-white">
                <td><?= h($video->videoTitle) ?></td>
                <td><?= h($video->eventTitle) ?></td>
                <td><?= $this->Html->link(h($video->userAssessments), ['controller' => "Assessments", 'action' => 'review', $video->id, 'own']) ?></td>
                <td><?= $this->Html->link(h($video->allAssessments), ['controller' => "Assessments", 'action' => 'review', $video->id, 'all']) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>