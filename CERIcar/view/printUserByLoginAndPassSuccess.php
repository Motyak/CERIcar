<?php if($context->utilisateur == null) : ?>
Aucune utilisateur n'a été trouvé
<?php else : ?>
Bonjour <?php echo $context->utilisateur->prenom," ",$context->utilisateur->nom ?> !
<?php endif; ?>