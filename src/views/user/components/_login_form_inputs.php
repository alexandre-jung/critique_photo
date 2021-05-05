<p class='form-group'>
    <label for="login">Identifiant</label>
    <input type="text" class='form-control' name="login" id="login" value='<?= $login ?>' tabindex="1"
        placeholder="utilisateur@gmail.com">
</p>
<p class='form-group'>
    <label for="password">Mot de passe</label>
    <input type="password" class='form-control' name="password" id="password" tabindex="2">
    <input type='checkbox' class='show-password' data-target='password' id='showPassword'>
    <label for="showPassword">Afficher</label>
</p>