<?php
if(isset($_POST['del_novedad'])){
  $id=MysqlQuery::RequestPost('del_novedad');

  if(MysqlQuery::Eliminar("novedad", "serie='$id'")){
    echo '
        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-center">NOVEDAD ELIMINADO</h4>
            <p class="text-center">
                La novedad fue eliminado con exito
            </p>
        </div>
    ';
  }else{
    echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
            <p class="text-center">
                Lo sentimos, no hemos podido eliminar la novedad
            </p>
        </div>
    ';
  }
}


$email_consul=  MysqlQuery::RequestGet('email_consul');
$id_colsul= MysqlQuery::RequestGet('id_consul');


$consulta_tablanovedad=Mysql::consulta("SELECT * FROM novedad WHERE serie= '$id_colsul' AND email_cliente='$email_consul' ");
if(mysqli_num_rows($consulta_tablanovedad)>=1){
  $lsT=mysqli_fetch_array($consulta_tablanovedad, MYSQLI_ASSOC);   
?>
        <div class="container">
            <div class="row well">
            <div class="col-sm-2">
                <img src="img/status.png" class="img-responsive" alt="Image">
            </div>
            <div class="col-sm-10 lead text-justify">
              <h2 class="text-info">Estado de novedad</h2>
              <p>Si su <strong>novedad</strong> no ha sido solucionado aún, espere pacientemente, estamos verificando</p>
            </div>
          </div><!--fin row well-->
          <div class="row">
              <div class="col-sm-12">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center"><h4><i class="fa fa-novedad"></i> ID NOVEDAD &nbsp;#<?php echo $lsT['serie']; ?></h4></div>
                      <div class="panel-body">
                          <div class="container">
                              <div class="col-sm-12">
                                  <div class="row">
                                      <div class="col-sm-4">
                                          <img class="img-responsive" alt="Image" src="img/tux_repair.png">
                                      </div>
                                      <div class="col-sm-8">
                                          <div class="row">
                                              <div class="col-sm-6"><strong>Fecha:</strong> <?php echo $lsT['fecha']; ?></div>
                                              <div class="col-sm-6"><strong>Estado:</strong> <?php echo $lsT['estado_novedad']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-6"><strong>Nombre:</strong> <?php echo $lsT['nombre_usuario']; ?></div>
                                              <div class="col-sm-6"><strong>Email:</strong> <?php echo $lsT['email_cliente']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-6"><strong>Departamento:</strong> <?php echo $lsT['departamento']; ?></div>
                                              <div class="col-sm-6"><strong>Asunto:</strong> <?php echo $lsT['asunto']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-12"><strong>Problema:</strong> <?php echo $lsT['mensaje']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-12"><strong>Solución:</strong> <?php echo $lsT['solucion']; ?></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="panel-footer text-center">
                          <div class="row">
                              <h4>Opciones</h4>
                              <div class="col-sm-6">
                                  <form action="" method="POST">
                                      <input type="text" value="<?php echo $lsT['serie']; ?>" name="del_novedad" hidden="">
                                      <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;  Eliminar novedad</button>
                                  </form>
                              </div>
                          </div>
                      </div>

                    </div>
              </div>
          </div>
        </div>
 <?php }else{ ?>
        <div class="container">
            <div class="row  animated fadeInDownBig">
                <div class="col-sm-4">
                    <img src="img/error.png" alt="Image" class="img-responsive"/><br>
                    <img src="img/SadTux.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 text-center">
                    <h1 class="text-danger">Lo sentimos ha ocurrido un error al hacer la consulta, esto se debe a lo siguiente:</h1>
                    <h3 class="text-warning"><i class="fa fa-check"></i> El novedad ha sido eliminado completamente.</h3>
                    <h3 class="text-warning"><i class="fa fa-check"></i> Los datos ingresados no son correctos.</h3>
                    <br>
                    <h3 class="text-primary"> Por favor verifique que su <strong>id novedad</strong> y <strong>email</strong> sean correctos, e intente nuevamente.</h3>
                    <h4><a href="./index.php?view=soporte" class="btn btn-primary"><i class="fa fa-reply"></i> Regresar a soporte</a></h4>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php } ?>
<script>
  $(document).ready(function(){
    $("button#save").click(function (){
       window.open ("./lib/pdf_user.php?id="+$(this).attr("data-id"));
    });
  });
</script>

<script>
  $(document).ready(function(){
    $("button#saved").click(function (){
       window.open ("./lib/pdf.php?id="+$(this).attr("data-id"));
    });
  });
</script>