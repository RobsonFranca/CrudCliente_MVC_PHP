<?php 
$util = new App\Lib\Util();
$properties = $util->getProperty($item);
function colocar($value){
	?>
	<input type="text" value="<?php echo $value['value'];?>" name="<?php echo $value['property']; ?>" hidden>
	<?php
}

?>
<div class="container">
	<form method="POST" action="<?php echo $util->getBase().$util->get_name_class($item)."/update/" ?>">
		<?php foreach ($properties as $value) {?>
        	<div class="form-group">
			    <label><?php echo $value['name']; ?></label>
			    <input type="text" class="form-control" id="<?php echo $value['property']; ?>" name="<?php echo $value['property']; ?>" value="<?php echo $value['value'];?>"
			      <?php echo $value['property']==$primary?"disabled":""; ?>>
			    <?php echo $value['property']==$primary?colocar($value):"";?>
			</div>
      	<?php } ?>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>