<?php if(isset($_SESSION['authUser'])): ?>
<p><strong>Bonjour <?php echo $context->authUser->prenom . " " . $context->authUser->nom . " !"?></strong></p>
<?php endif; ?>
<p>Bienvenue sur la page index</p>
<p>C'est l'action par défaut</p>
