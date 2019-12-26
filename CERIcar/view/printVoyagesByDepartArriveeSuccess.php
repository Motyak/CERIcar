<div class="table-responsive">
<?php if($context->voyages==null): ?>
	<div class='alert alert-warning'>
    	<strong>Info : </strong>
    	Aucun voyage n'a été trouvé
  	</div>
<?php endif; ?>
<table id="voyages" class="table table-hover">
	<thead>
		<tr>
			<th>CONDUCTEUR</th>
			<th>TARIF</th>
			<th>NB PLACES</th>
			<th>HEURE DEPART</th>
			<?php if(isset($_SESSION['authUser'])): ?>
			<!-- colonne sans titre pour bouton reserver -->
			<th></th>
			<?php endif; ?>
		</tr>
	</thead>
	<?php if($context->voyages!=null): ?>
		<?php foreach($context->voyages as $voyage): ?>
			<tr>
				<!-- colonne0 : ID voyage (caché) -->
				<td hidden name="idVoy"><?php echo $voyage->id; ?></td>
			
				<!-- colonne1 : conducteur -->
				<td><?php echo $voyage->conducteur->prenom . " " . $voyage->conducteur->nom; ?></td>
			
				<!-- colonne2 : tarif -->
				<td><?php echo $voyage->tarif . '€'; ?></td>
			
				<!-- colonne3 : nbplace -->
				<td><?php echo $voyage->nbplace; ?></td>
			
				<!-- colonne4 : heuredepart -->
				<td><?php echo $voyage->heuredepart . 'h'; ?></td>

				<?php if(isset($_SESSION['authUser'])): ?>
				<!-- colonne5 : bouton reserver -->
				<td> <button class="invisible" type="button" name="reserver">Réserver</button> </td>
				<?php endif; ?>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>
</div>
