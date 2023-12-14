<div container>
    <div class="col-md-12 text-left">
        <h1>Bienvenue sur CanneTrainer</h1>
    </div>
    <div class="col-md-12 text-center">
        <h2>Compétitions</h2>
    </div>
    <div class="col-md-12 text-center">
        <table class="table table-dark table-hover table-striped">
            <thead>
                <tr class="text-white">
                    <th>Date</th>
                    <th>Compétitions</th>
                </tr>
            </thead>

            <?php foreach ($events as $event) : ?>
                <tr class="text-white">
                    <td><?= h($event->date->format('d/m/y')) ?></td>
                    <td><?= $this->Html->link($event->title, ['controller' => 'Videos', 'action' => 'index', $event->id]) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

