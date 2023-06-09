<div class="container text-center">
    <h1 class='m-5'><?= h($video->title) ?></h1>

    <div class="row align-items-center">
        <div class="col align-self-center">
            <?php $color = 'red'; ?>
            <div class="col">
                <?= $this->Form->create() ?>
                <?= $this->Form->hidden('color_point', ['value' => 'red']) ?>
                <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                <?= $this->Form->hidden('assessment_id', ['value' => $assessmentId]) ?>
                <?= $this->Form->button($points['red'], ['class' => 'btn btn-danger']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col">
            <!-- <video src="<?= h($video->url) ?>" controls></video> -->
            <iframe width="560" height="315" src="https://www.youtube.com/embed/B25BcD8HEGQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div class="col align-self-center">
            <?php $color = 'blue'; ?>
            <div class="col">
                <?= $this->Form->create() ?>
                <?= $this->Form->hidden('color_point', ['value' => 'blue']) ?>
                <?= $this->Form->hidden('video_id', ['value' => $video->id]) ?>
                <?= $this->Form->hidden('assessment_id', ['value' => $assessmentId]) ?>
                <?= $this->Form->button($points['blue'], ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>






</div>