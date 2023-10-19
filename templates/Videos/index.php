<div container>
    <div class="col-md-12 text-left">
        <h1>Bienvenue sur CanneTrainer</h1>
    </div>
    <div class="col-md-12 text-center">
        <?php foreach ($videos as $video) : ?>
            <h2><?= h($video->event->title) ?></h2>
        <?php endforeach ?>

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
                            $video->id,
                            '?' => ['newAssessment' => 1]
                        ], [
                            'class' => 'btn btn-outline-primary'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>



    <!-- Afficher les compétitions récupérées depuis l'API CanneTV -->
    <!-- <div class="col-md-12 text-center">
        <h2>Compétitions CanneTV</h2>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Date</th>
            </tr>
            <?php foreach ($tournaments as $tournament) : ?>
                <tr>
                    <td><?= h($tournament['name']) ?></td>
                    <td><?= h($tournament['date']) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div> -->
</div>