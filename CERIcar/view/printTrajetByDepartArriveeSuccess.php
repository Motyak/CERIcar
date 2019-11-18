<?php if($context->trajet == null) : ?>
Aucune trajet n'a été trouvé
<?php else : ?>
Id : <?php echo $context->trajet->id ?><br>
Depart : <?php echo $context->trajet->depart ?><br>
Arrivée : <?php echo $context->trajet->arrivee ?><br>
Distance : <?php echo $context->trajet->distance ?><br>
<?php endif; ?>