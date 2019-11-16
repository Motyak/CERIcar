<table id="voyages">
	<thead>
		<tr>
			<th>CONDUCTEUR</th>
			<th>TARIF</th>
			<th>NB PLACES</th>
			<th>HEURE DEPART</th>
		</tr>
	</thead>
	<?php 
	if($context->voyages!=null)
	{
		foreach($context->voyages as $voyage)
		{
			//colonne1 : conducteur
			echo "<tr>\n\t\t\t<td>",
			$voyage->conducteur->prenom," ",
			$voyage->conducteur->nom,
			
			//colonne2 : tarif
			"</td>\n\t\t\t<td>",$voyage->tarif,
			
			//colonne3 : nbplace
			"</td>\n\t\t\t<td>",$voyage->nbplace,
			
			//colonne4 : heuredepart
			"</td>\n\t\t\t<td>",$voyage->heuredepart,
			"</td>";
		}
	}
	?>
</table>

