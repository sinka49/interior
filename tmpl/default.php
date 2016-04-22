<?php JHtml::stylesheet(Juri::base() . 'modules/mod_interior/css/style_interior.css');?> 
<script type="text/javascript">
	function changeInterior (context, param, param2) {
		if (param2 =="img") 
			var resourse = context.children[0].getAttribute("src");

		else 
			var resourse = context.children[0].style.background;
		
		var arrayElem  = document.getElementsByClassName(param);
		for (var elem  = 0; elem < arrayElem.length; elem ++) {
			if (param2 =="img") 
				arrayElem[elem].style.background = "url(" + resourse + ") repeat";
			else
				arrayElem[elem].style.background = resourse;
			arrayElem[elem].style.backgroundSize = "70px";
		};
	}
</script>

<div class = "mod_interior">
		<div class="room">
			<div class="ceiling"></div>
			<div class="wall stenaa"> </div>
			<div class="wall stenab"></div>
			<div class="wall stenaс"></div>
			<div class="floor"></div>
		</div>


<?php if ($arrayCeiling):?>
	
	<h3>Потолок</h3>
	<ul>
	<?php foreach ($arrayCeilingCats as $keyCat => $Cat): ?>
		<li>
			<h4><?php echo $Cat["cat_name"];?></h4>
				<br>
				<ul>
				<?php foreach ($arrayCeiling as $keyC => $valueC){ ?>
					<?php if ($valueC["cat_id"] == $Cat["cat_id"] ){ ?>
						<li class="floating"><a href="#" onclick="changeInterior(this, 'ceiling','img'); return false"><img src="modules/mod_interior/<?php echo $valueC["src_resource"] ?>"></a></li>
					<?php } ?>
				<?php } ?>
				</ul>
		</li>
		
	<?php endforeach ?>
	<?php if ($arrayCeilingColors): ?>
		<h4>Цвета</h4>
		<ul>
		<?php foreach ($arrayCeilingColors as $keyC => $valueC){ ?>
				<li class="floating"><a href="#" onclick="changeInterior(this, 'ceiling','color'); return false"><div style="height:40px; width:40px; background:<?php echo $valueC['color_code'];?>"></div></a></li>
		<?php } ?>
	</ul>
	<?php endif ?>
	</ul>
<?php endif ?>
<?php if ($arrayWall): ?>
	<h3>Стены</h3>
	<ul>
	<?php foreach ($arrayWallCats as $keyCat => $Cat): ?>
		<li>
			<h4><?php echo $Cat["cat_name"];?></h4>
				<br>
				<ul>
				<?php foreach ($arrayWall as $keyC => $valueC){ ?>
					<?php if ($valueC["cat_id"] == $Cat["cat_id"] ){ ?>
						<li class="floating"><a href="#" onclick="changeInterior(this, 'wall', 'img'); return false"><img src="modules/mod_interior/<?php echo $valueC["src_resource"] ?>"></a></li>
					<?php } ?>
				<?php } ?>
				</ul>
		</li>
		
	<?php endforeach ?>

	<?php if ($arrayWallColors): ?>
		<h4>Цвета</h4>
		<ul>
		<?php foreach ($arrayWallColors as $keyC => $valueC){ ?>
				<li class="floating"><a href="#" onclick="changeInterior(this, 'wall','color'); return false"><div style="height:40px; width:40px; background:<?php echo $valueC['color_code'];?>"></div></a></li>
		<?php } ?>
	</ul>
	<?php endif ?>
	</ul>
<?php endif ?>
	<?php if ($arrayFloor): ?>
	<h3>Пол</h3>
	<ul>
		<?php foreach ($arrayFloor as $keyC => $valueC){ ?>
				<li class="floating"><a href="#" onclick="changeInterior(this, 'floor','img'); return false"><img src="modules/mod_interior/<?php echo $valueC["src_resource"] ?>"></a></li>
		<?php } ?>
		<?php if ($arrayFloorColors): ?>
		<h4>Цвета</h4>
		<ul>
		<?php foreach ($arrayFloorColors as $keyC => $valueC){ ?>
				<li class="floating"><a href="#" onclick="changeInterior(this, 'floor','color'); return false"><div style="height:40px; width:40px; background:<?php echo $valueC['color_code'];?>"></div></a></li>
		<?php } ?>
	</ul>
	<?php endif ?>
	</ul>
	<?php endif ?>
 </div>
</body>
</html>