<?php
$this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
)) ?>

<?= $this->Html->script('review.js') ?>


<!-- Ajout du bloc pour les messages flash -->
<div class='row'>
    <div class='col'>
        <?= $this->Flash->render() ?>
    </div>
</div>

<div class='container text-center'>
    <h1><?= h($video->title) ?></h1>

    <div class='row align-items-center'>
        <video id='video' controls='true'>
            <source src='https://canne.tv/replay/video/3513/A/2022-01-21_10-20-00___2022-01-21_10-34-18.mp4' type='video/mp4' style='width:100%' />
        </video>
    </div>

    <div id='global-flag-bar' class='flag-display-container' title='<?= $video->id ?>'>
        <?php foreach ($allFlagPoints as $point) : ?>
            <div class="point-flag <?= h($point['color']) ?>" title="<?= floor($point['timing']) . 's' ?>" data-time="<?= $point['timing'] ?>"></div>      
        <?php endforeach; ?>
    </div>
    
    <div>
        <?php foreach ($pointsPerAssessments as $assessmentId => $flagPoints) : ?>
            <?php if (count($flagPoints) > 0) : ?>
                <div id='assessment-<?= $assessmentId ?>' class='flag-display-container' title='<?= $assessmentId ?>'>
                    <?php foreach ($flagPoints as $point) : ?>
                        <div class='point-flag <?= h($point['color']) ?>' title='<?= $assessmentId . ':' . floor($point['timing']) . 's' ?>' data-time='<?= $point['timing'] ?>'></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
