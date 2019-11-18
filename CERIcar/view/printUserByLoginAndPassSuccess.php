<?php if($context->res == null) : ?>
Aucune utilisateur n'a été trouvé
<?php else : ?>
Bonjour <?php echo $context->res->prenom," ",$context->res->nom ?> !
<?php endif; ?>