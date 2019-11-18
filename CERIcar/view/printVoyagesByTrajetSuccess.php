<?php if($context->voyages == null) : ?>
Aucun voyage n'a été trouvé
<?php else : ?>
<table id="voyages">
	<thead>
		<tr>
			<th>ID</th>
			<th>CONDUCTEUR</th>
			<th>TRAJET</th>
			<th>TARIF</th>
			<th>NB PLACE</th>
			<th>HEURE DEPART</th>
			<th>CONTRAINTES</th>
		</tr>
	</thead>
	<?php 
	foreach($context->voyages as $voyage)
	{
		//colonne1 : id
		echo "<tr>\n\t\t\t<td>",$voyage->id,
		//colonne2 : conducteur
		"</td>\n\t\t\t<td>",
		"\n\t\t\t\t<ul>",
		"\n\t\t\t\t\t<li>","id : ",$voyage->conducteur->id,"</li>",
		"\n\t\t\t\t\t<li>","nom : ",$voyage->conducteur->nom,"</li>",
		"\n\t\t\t\t\t<li>","prenom : ",$voyage->conducteur->prenom,"</li>",
		"\n\t\t\t\t\t<li>","avatar : ",$voyage->conducteur->avatar,"</li>",
		"\n\t\t\t\t</ul>",
		//colonne3 : trajet
		"</td>\n\t\t\t<td>",
		"\n\t\t\t\t<ul>",
		"\n\t\t\t\t\t<li>","id : ",$voyage->trajet->id,"</li>",
		"\n\t\t\t\t\t<li>","depart : ",$voyage->trajet->depart,"</li>",
		"\n\t\t\t\t\t<li>","arrivee : ",$voyage->trajet->arrivee,"</li>",
		"\n\t\t\t\t\t<li>","distance : ",$voyage->trajet->distance,"</li>",
		"\n\t\t\t\t</ul>",
		//colonne4 : tarif
		"</td>\n\t\t\t<td>",$voyage->tarif,
		//colonne5 : nbplace
		"</td>\n\t\t\t<td>",$voyage->nbplace,
		//colonne6 : heuredepart
		"</td>\n\t\t\t<td>",$voyage->heuredepart,
		//colonne7 : contraintes
		"</td>\n\t\t\t<td>",$voyage->contraintes,
		"</td>";
	}
	?>
</table>
<?php endif; ?>
