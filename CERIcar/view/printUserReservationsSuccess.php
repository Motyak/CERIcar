<div class="table-responsive">
<?php if($context->reservations==null): ?>
	<div class='alert alert-info'>
    	<strong>Info : </strong>
    	Aucune réservation n'a été trouvée
  	</div>
<?php endif; ?>
<table id="reservations" class="table table-hover">
	<thead>
		<tr>
			<th>N°</th>
			<th>DEPART</th>
			<th>ARRIVEE</th>
			<th>HEURE DEPART</th>
			<th>CONDUCTEUR</th>
		</tr>
	</thead>
	<?php foreach($context->reservations as $reservation): ?>
		<tr>
			<!-- colonne1 : n° -->
			<td><?php echo $reservation->id; ?></td>
		
			<!-- colonne2 : depart -->
			<td><?php echo $reservation->voyage->trajet->depart; ?></td>

			<!-- colonne3 : arrivee -->
			<td><?php echo $reservation->voyage->trajet->arrivee; ?></td>

			<!-- colonne4 : heure depart -->
			<td><?php echo $reservation->voyage->heuredepart . "h"; ?></td>

			<!-- colonne5 : conducteur -->
			<td><?php echo $reservation->voyage->conducteur->prenom . " " . $reservation->voyage->conducteur->nom; ?></td>
	<?php endforeach; ?>
</table>
</div>
