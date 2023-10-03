<?php $this->assign('title', __('S\'inscrire')); ?>

<h1><?= __('S\'inscrire') ?></h1>
<?= $this->Form->create($user) ?>
<?php
echo $this->Form->control('username', [
    'label' => __('Adresse électronique'),
    'type' => 'email',
    'required' => true,
]);
echo $this->Form->control('password', [
    'label' => __('Mot de passe'),
    'required' => true,
]);
echo $this->Form->control('first_name', [
    'label' => __('Prénom'),
    'required' => true,
]);
echo $this->Form->control('last_name', [
    'label' => __('Nom de famille'),
    'required' => true,
]);
echo $this->Form->control('birth_date', [
    'label' => __('Date de naissance'),
    'required' => true,
    'minYear' => date('Y') - 90,
    'maxYear' => date('Y') - 3,
    'orderYear' => 'asc',
    'default' => (date('Y') - 30) . "-06-15",
]);
$sexnames = $user->getSexNames();
unset($sexnames[0]);
unset($sexnames[3]);
echo $this->Form->control('sex', [
    'label' => __('Sexe'),
    'required' => true,
    'options' => $sexnames,
]);
?>

<?= $this->Form->submit(__('Inscription')) ?>
<?= $this->Form->end() ?>
    
    
    <div class="row">
        <nav class='col d-none d-lg-block navbar navbar-dark bg-dark' id='localnav'></nav>
        <main class='col-12 col-lg-8 p-3'>
            <h1>S'inscrire</h1>
            <form method="post" accept-charset="utf-8" action="/personals/register">
                <div style="display:none;">
                    <input type="hidden" class="form-control" name="_csrfToken" autocomplete="off" value="z5qjplJsy3Wf9FwkeYLPt0KyfpOeHFkcEeM2cZ2zAknhhWrpxo3GGsn/J3faEYx/HdotGwkJGYmQkqpa5T5M+YtGWaK2HUZqd9Ebo6glPyhy1lNJrdU7cNTgX433vP4srJ4VRul1tEwkv0spbzp6vA==" />
                </div>
                <div class="form-group" email required>
                    <label for="username">Adresse électronique</label>
                    <input type="email" class="form-control" name="username" required="required" data-validity-message="Ce champ ne peut être laissé vide" oninvalid="this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity(&#039;&#039;)" id="username" aria-required="true" maxlength="255" />
                </div>
                <div class="form-group" password required>
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" required="required" data-validity-message="Ce champ ne peut être laissé vide" oninvalid="this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity(&#039;&#039;)" id="password" aria-required="true" />
                </div>
                <div class="form-group" text required>
                    <label for="first-name">Prénom</label>
                    <input type="text" class="form-control" name="first_name" required="required" data-validity-message="Ce champ ne peut être laissé vide" oninvalid="this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity(&#039;&#039;)" id="first-name" aria-required="true" maxlength="255" />
                </div>
                <div class="form-group" text required>
                    <label for="last-name">Nom de famille</label>
                    <input type="text" class="form-control" name="last_name" required="required" data-validity-message="Ce champ ne peut être laissé vide" oninvalid="this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity(&#039;&#039;)" id="last-name" aria-required="true" maxlength="255" />
                </div>
                <div class="form-group" date required>
                    <label for="birth-date">Date de naissance</label>
                    <input type="date" class="form-control" name="birth_date" required="required" minYear="1933" maxYear="2020" orderYear="asc" data-validity-message="Ce champ ne peut être laissé vide" oninvalid="this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity(&#039;&#039;)" id="birth-date" aria-required="true" value="1993-06-15" />
                </div>
                <div class="form-group" select required>
                    <label for="sex">Sexe</label>
                    <select name="sex" class="form-control" required="required" data-validity-message="Ce champ ne peut être laissé vide" oninvalid="this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity(&#039;&#039;)" id="sex">
                        <option value="1">Homme</option>
                        <option value="2">Femme</option>
                    </select>
                </div>
                <div class="submit">
                    <input type="submit" class="btn btn-outline-primary" value="Inscription" />
                </div>
            </form>
        </main>
        <aside class='col d-none d-lg-block' id='complinfo'></aside>
    </div>