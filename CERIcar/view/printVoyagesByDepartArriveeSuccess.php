<div class="table-responsive">
<?php
if($context->voyages==null){
	echo "<div class='alert alert-info'>",
    "<strong>Info : </strong>",
    "Aucun voyage n'a été trouvé",
  "</div>";
}
?>
<table id="voyages" class="table table-hover">
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
			echo "<tr>\n\t\t<td>",
			$voyage->conducteur->prenom," ",
			$voyage->conducteur->nom,
			
			//colonne2 : tarif
			"</td>\n\t\t<td>",$voyage->tarif,
			
			//colonne3 : nbplace
			"</td>\n\t\t<td>",$voyage->nbplace,
			
			//colonne4 : heuredepart
			"</td>\n\t\t<td>",$voyage->heuredepart,
			"</td>\n\t</tr>\n\t";
		}
	}
	?>
</table>
</div>
