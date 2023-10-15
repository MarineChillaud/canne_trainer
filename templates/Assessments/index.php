<div container>
    <div class="col-md-12 text-left">
        <h1>Mes évaluations</h1>
    </div>

</div>
<div class="col-md-12 text-center">
    <table class="table">
        <tr class="text-white">
            <th>Compétition</th>
            <th>Rencontre</th>
            <th>Date</th>
            <th>Evaluations joueur</th>
            <th>Toutes les évaluations </th>
        </tr>

        <?php foreach ($videos as $video) : ?>
            <tr class="text-white">
                <td><?= h($video->eventTitle) ?></td>
                <td><?= h($video->videoTitle) ?></td>
                <td><?= date('d/m/y H:i', strtotime($video->date)) ?></td>
                <td><?= h($video->userAssessments) ?></td>
                <td><?= h($video->allAssessments) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>