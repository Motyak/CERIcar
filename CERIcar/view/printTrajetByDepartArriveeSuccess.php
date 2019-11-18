<?php if($context->res == null) : ?>
Aucune trajet n'a été trouvé
<?php else : ?>
Id : <?php echo $context->res->id ?><br>
Depart : <?php echo $context->res->depart ?><br>
Arrivée : <?php echo $context->res->arrivee ?><br>
Distance : <?php echo $context->res->distance ?><br>
<?php endif; ?>