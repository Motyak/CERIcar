<?php require("addStyle.html"); ?>
<?php if($context->voyages == null) : ?>
Aucun voyage n'a été trouvé
<?php else : ?>
<table id="voyages">
	<thead>
		<tr>
			<th>CONDUCTEUR</th>
			<th>TRAJET</th>
			<th>TARIF</th>
			<th>NB PLACES</th>
			<th>HEURE DEPART</th>
		</tr>
	</thead>
	<?php 
	foreach($context->voyages as $voyage)
	{
		//colonne1 : conducteur
		echo "<tr>\n\t\t\t<td>",
		$voyage->conducteur->prenom," ",
		$voyage->conducteur->nom,

		//colonne3 : trajet
		"</td>\n\t\t\t<td>",
		$voyage->trajet->depart,"-",
		$voyage->trajet->arrivee,
		
		//colonne4 : tarif
		"</td>\n\t\t\t<td>",$voyage->tarif,
		
		//colonne5 : nbplace
		"</td>\n\t\t\t<td>",$voyage->nbplace,
		
		//colonne6 : heuredepart
		"</td>\n\t\t\t<td>",$voyage->heuredepart,
		"</td>";
	}
	?>
</table>
<?php endif; ?>
