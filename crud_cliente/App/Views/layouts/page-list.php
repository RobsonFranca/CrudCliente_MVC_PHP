<?php 
$util = new App\Lib\Util();
$properties = $util->getProperty($class);
?>
<div class="container">
<div class="row">
  <div class="col-md-1">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active btn-dark" id="v-pills-home-tab" data-toggle="pill" href="<?php echo $util->getBase().$util->get_name_class($class)."/create/" ?>" role="tab" aria-controls="v-pills-home" aria-selected="true">Criar</a>
    </div>
  </div>
  <div class="col-md-11">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <?php foreach ($properties as $value) {?>
            <th scope="col"><?php echo $value['name']; ?></th>
          <?php } ?>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($item as $value) {?>

          <tr>
            <?php foreach (get_object_vars($value) as $key => $row) {?>
              <th><?php echo $row; ?></th>
            <?php } ?>
            <th>
              <a href="<?php echo $util->getBase().$util->get_name_class($item[0])."/update/".$value->cpfcliente."/"; ?>">Editar</a>
              <a href="<?php echo $util->getBase().$util->get_name_class($item[0])."/delete/".$value->cpfcliente."/"; ?>">Excluir</a>
            </th>
          </tr>
        <?php } ?>
      </tbody>
    </table>	
  </div>
</div>
</div>


        <!-- <th scope="row"></th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td> -->