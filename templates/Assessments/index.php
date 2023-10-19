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
            <th>Date</th>
            <th>Evaluations joueur</th>
            <th>Toutes les évaluations </th>
        </tr>

        <?php foreach ($videos as $video) : ?>
            <tr class="text-white">
                <td>
                    <!-- <div class="accordion" id="accordion<?= $video->id ?>">
                        <div class="accordion-header">
                            <i class="fas fa-chevron-right">&nbsp;</i><?= h($video->videoTitle) ?>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-header">
                                <i class="fas fa-chevron-right">&nbsp;</i>Comparer mes évaluations
                            </div>
                        </div>
                        <div class="accordion-content">
                            Comparer toutes les évaluations -->
                    <!-- </div>
</div> -->
                    <!-- <div class="accordion accordion-flush" id="accordionAssessments<?= $video->id ?>">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <?= h($video->videoTitle) ?>
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionAssessments">
            <div class="accordion-body">
                <div>
                    <ul>
                        <li>Comparer mes évaluations</li>
                        <li>Comparer toutes les évaluations</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> -->

                    <div class="accordion accordion-flush" id="accordionAssessments">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <?= h($video->videoTitle) ?>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionAssessments">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                            </div>
                        </div>
                </td>
                <td><?= h($video->eventTitle) ?></td>
                <td><?= date('d/m/y H:i', strtotime($video->date)) ?></td>
                <td><?= h($video->userAssessments) ?></td>
                <td><?= h($video->allAssessments) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>


<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Accordion Item #1
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Accordion Item #2
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Accordion Item #3
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
        </div>
    </div>
</div>