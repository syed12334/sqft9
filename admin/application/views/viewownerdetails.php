
<?php
	if(count($owner)) {
		?>
		<p style="font-weight: bold;margin-bottom: 4px!important">Owner Name : <?= $owner[0]->oname;?> </p>
<p style="font-weight: bold;margin-bottom: 4px!important">Owner Email : <?= $owner[0]->oemail;?></p>
<p style="font-weight: bold;margin-bottom: 4px!important">Owner Phone : <?= $owner[0]->ophone;?></p>
		<?php
	}else {
		echo "No results";
	}
?>
