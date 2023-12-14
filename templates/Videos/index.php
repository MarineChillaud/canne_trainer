<div container>
    
    <div class="col-md-12 text-center">
        <h2><?= h($event->title) ?></h2>
    </div>

    <div class="col-md-12 text-center">
        <table class="table table-dark table-hover table-striped">
            <tr class="text-white">
                <th>Date</th>
                <th>Rencontre</th>
                <th>Evaluations joueur</th>
                <th>Toutes les évaluations </th>
                <th>Lancer une nouvelle évaluation</th>
            </tr>

            <?php foreach ($videos as $video) : ?>
                <tr class="text-white">
                    <td><?= date('d/m/y H:i', strtotime($video->date)) ?></td>
                    <td><?= h($video->title) ?></td>
                    <td><?= h($video->userAssessments) ?></td>
                    <td><?= h($video->allAssessments) ?></td>
                    <td class='button-group'>
                        <?= $this->Html->Link(__('Lancer une nouvelle évaluation'), [
                            'controller' => 'Videos',
                            'action' => 'view',
                            $video->id
                        ], [
                            'class' => 'btn btn-outline-primary'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>