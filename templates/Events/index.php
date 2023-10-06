<div container>
    <div class="col-md-12 text-left">
        <h1>Bienvenue sur CanneTrainer</h1>
    </div>
    <div class="col-md-12 text-center">
        <h2>Vidéos</h2>
    </div>
    <div class="col-md-12 text-center">
        <table class="table mx-auto">
            <tr class="text-white">
                <th>Date</th>
                <th>Compétitions</th>
            </tr>

            <?php foreach ($events as $event) : ?>
                <tr class="text-white">
                    <td><?= h($event->date->format('d/m/y')) ?></td>
                    <td><?= $this->Html->link($event->title, ['controller' => 'Videos', 'action' => 'index', $event->assessment_id]) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>



<!-- Afficher les compétitions récupérées depuis l'API CanneTV
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
</div> -->