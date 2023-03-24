
<?php
	if(count($area) >0) {
		?>
		<ul class="autocomplete">
		<?php
		foreach ($area as $key => $value) {
			?>
			<li id="autocompletebtnn" data-id = "<?= $value->id;?>"><?= $value->areaname;?></li>
			<?php
		}

		?>
		</ul>
		<?php
	}else {
		echo "<p>No results found</p>";
	}
?>

                                                                    
                                                                