<!DOCTYPE html>
<html>

<head>
    <title>Titre de votre page</title>
    </head>
    <body>
        <div class="container text-center">
            <h1><?= h($video->title) ?></h1>
            <div class="row align-items-start">            
                <div class="col align-self-center">
                    <!-- <?php foreach ($points as $point) : ?> -->
                        <div class="col align-self-center">
                            <?= $this->Form->create(null, ['url' => ['controller' => 'Points', 'action' => 'add']]) ?>
                            <?= $this->Form->hidden('color_point', ['value' => 'rouge']) ?>
                            <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                            <?= $this->Form->button($redPointsCount, ['class' => "btn btn-danger"]) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    <!-- <?php endforeach; ?>                 -->
                </div>   
                <div class="col">
                    <!-- <video src="<?= h($video->url) ?>" controls></video> -->
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/B25BcD8HEGQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                    <!-- <?php foreach ($points as $point) : ?> -->
                        <div class="col align-self-center">
                            <?= $this->Form->create(null, ['url' => ['controller' => 'Points', 'action' => 'add']]) ?>
                            <?= $this->Form->hidden('color_point', ['value' => 'bleu']) ?>
                            <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                            <?= $this->Form->button($bluePointsCount, ['class' => "btn btn-primary"]) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    <!-- <?php endforeach; ?> -->
            </div>
            </div>
        </div>

        <div class="container text-center">
            <?= $this->Html->link('Retour à la liste des vidéos', ['action' => 'index']) ?>
        </div>

  </body>

</html>
