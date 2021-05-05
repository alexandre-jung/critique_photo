<p class='form-group'>
<div class="small text-muted" id="hints">
    Votre mot de passe doit comporter au moins 8 caractères dont:
    <ul class='ms-n3'>
        <li>1 minuscule</li>
        <li>1 majuscule</li>
        <li>1 chiffre</li>
        <li>1 caractère spécial (&amp,=,!,?,-,_,...)</li>
    </ul>
</div>

<label for="passwordCheck">Vérifier votre mot de passe</label>
<input type="password" class='form-control' name="passwordCheck" id="passwordCheck" tabindex="3">
<input type="checkbox" class='show-password' data-target='passwordCheck' id='showCheckPassword'>
<label for="showCheckPassword">Afficher</label>
</p class='form-group'>
<p>
    <label for="pseudo">Votre pseudo</label>
    <input type="text" class='form-control' name="pseudo" id="pseudo" tabindex="4" value='<?= $pseudo ?? '' ?>'>
</p>