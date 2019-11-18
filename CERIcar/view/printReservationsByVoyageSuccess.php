<?php if($context->reservations == null) : ?>
Aucune réservation n'a été trouvé
<?php else : ?>
<table id="reservations">
	<thead>
		<tr>
			<th>ID</th>
			<th>VOYAGE</th>
			<th>VOYAGEUR</th>
		</tr>
	</thead>
	<?php 
	foreach($context->reservations as $reservation)
	{
		//colonne1 : id
		echo "<tr>\n\t\t\t<td>",$reservation->id,
		//colonne2 : voyage
		"</td>\n\t\t\t<td>",
		"\n\t\t\t\t<ul>",
		"\n\t\t\t\t\t<li>","id : ",$reservation->voyage->id,"</li>",
		"\n\t\t\t\t\t<li>","conducteur(id) : ",$reservation->voyage->conducteur->id,"</li>",
		"\n\t\t\t\t\t<li>","trajet(id) : ",$reservation->voyage->trajet->id,"</li>",
		"\n\t\t\t\t\t<li>","tarif : ",$reservation->voyage->tarif,"</li>",
		"\n\t\t\t\t\t<li>","nbplace : ",$reservation->voyage->nbplace,"</li>",
		"\n\t\t\t\t\t<li>","heuredepart : ",$reservation->voyage->heuredepart,"</li>",
		"\n\t\t\t\t\t<li>","contraintes : ",$reservation->voyage->contraintes,"</li>",
		"\n\t\t\t\t</ul>",
		//colonne3 : voyageur
		"</td>\n\t\t\t<td>",
		"\n\t\t\t\t<ul>",
		"\n\t\t\t\t\t<li>","id : ",$reservation->voyageur->id,"</li>",
		"\n\t\t\t\t\t<li>","nom : ",$reservation->voyageur->nom,"</li>",
		"\n\t\t\t\t\t<li>","prenom : ",$reservation->voyageur->prenom,"</li>",
		"\n\t\t\t\t\t<li>","avatar : ",$reservation->voyageur->avatar,"</li>",
		"\n\t\t\t\t</ul></td>";
	}
	?>
</table>
<?php endif; ?>