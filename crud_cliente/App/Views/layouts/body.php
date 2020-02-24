<?php 
use App\Lib\Util;
$util = new Util();
 ?>
<body>
	<nav class="navbar navbar-dark bg-dark">
		<a class="navbar-brand" href="<?php echo $util->getBase(); ?>cliente/index/"><?php echo $title ?></a>
	</nav>

	<?php include "App/Views/layouts/page-$type.php"; ?>
</body>