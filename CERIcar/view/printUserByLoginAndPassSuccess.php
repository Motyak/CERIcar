<?php if($context->user == null) : ?>
Aucune utilisateur n'a été trouvé
<?php else : ?>
Bonjour <?php echo $context->user->prenom," ",$context->user->nom ?> !
<?php endif; ?>