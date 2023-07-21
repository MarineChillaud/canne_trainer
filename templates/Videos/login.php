<div container>
    <div class="col-md-12 text-left mb-4">
        <h1>Connexion / Inscription</h1>
    </div>

    <div type="form" class="col-md-12 text-left">
        <?= $this->Form->create(null, ['url' => ['label' => false, 'controller' => 'Videos', 'action' => 'login']]) ?>
        <div class="form-group mb-4">
            <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Adresse e-mail', 'class' => 'form-control-lg', 'style' => 'width: 500px']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->password('password', ['placeholder' => 'Mot de passe', 'class' => 'form-control-lg', 'style' => 'width: 500px']) ?>
        </div>
        <div class="form-group d-flex align-items-center mb-4">
            <div>
                <?= $this->Form->checkbox('remember', ['label' => false]) ?>
                Rester connecté
            </div>
            <div class="ml-auto">
                <?= $this->Html->link('Mot de passe oublié', ['controller' => 'Videos', 'action' => 'forgotPassword']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->button('Connexion') ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>