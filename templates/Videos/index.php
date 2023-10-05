<div container>
    <div class="col-md-12 text-left">
        <h1>Bienvenue sur CanneTrainer</h1>
    </div>
    <div class="col-md-12 text-center">
        <h2>Vidéos</h2>
    </div>
    <div class="col-md-12 text-center">
        <table class="table">
            <tr>
                <th>Titre</th>
                <th>Compétitions</th>
                <th>Date</th>
            </tr>

            <?php foreach ($videos as $video) : ?>
                <tr>
                    <td><?= $this->Html->link($video->title, ['controller' => 'Videos', 'action' => 'view', $video->id]) ?></td>
                    <td><?= h($video->event->title) ?></td>
                    <td><?= h($video->date) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>



    <!-- Afficher les compétitions récupérées depuis l'API CanneTV -->
    <div class="col-md-12 text-center">
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
    </div>
</div>