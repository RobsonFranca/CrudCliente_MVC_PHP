<?php 
$util = new App\Lib\Util();
$properties = $util->getProperty($item);
?>
<div class="container">
	<form method="POST" action="<?php echo $util->getBase().$util->get_name_class($item)."/create/" ?>">
		<?php foreach ($properties as $value) {?>
        	<div class="form-group">
			    <label for="exampleInputEmail1"><?php echo $value['name']; ?></label>
			    <input type="text" class="form-control" id="<?php echo $value['property']; ?>" aria-describedby="emailHelp" name="<?php echo $value['property']; ?>">
			</div>
      	<?php } ?>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>