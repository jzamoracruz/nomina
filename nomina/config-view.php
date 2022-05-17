<?php if($_SESSION['nombre']!="" && $_SESSION['tipo']=="nomina"){ 

/* Guardar nuevo nomina */
  if(isset($_POST['nom_cliente_reg']) && isset($_POST['cliente_reg']) && isset($_POST['cliente_clave_reg'])){

    $nom_complete_save=MysqlQuery::RequestPost('nom_cliente_reg');
    $nom_cliente_save=MysqlQuery::RequestPost('cliente_reg');
    $pass_save=md5(MysqlQuery::RequestPost('cliente_clave_reg'));
    $email_save=MysqlQuery::RequestPost('cliente_email_reg');
    $salrio_save=MysqlQuery::RequestPost('cliente_salario_reg');
    $cargo_save=MysqlQuery::RequestPost('cliente_cargo_reg');

   if(MysqlQuery::Guardar("cliente", "nombre_completo, nombre_usuario, clave, email_cliente, salario, cargo", "'$nom_complete_save', '$nom_cliente_save', '$pass_save', '$email_save', '$salrio_save', '$cargo_save'")){
       echo '
            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">EMPLEADO REGISTRADO</h4>
                <p class="text-center">
                    El empleado se registro con exito en el sistema
                </p>
            </div>
        ';
   }else{
       echo '
            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                <p class="text-center">
                    No hemos podido registrar al empleado
                </p>
            </div>
        ';
   } 
}



   /* Actualizar cuenta nomina */
    
    if(isset($_POST['nom_nomina_up']) && isset($_POST['nomina_up']) && isset($_POST['old_nom_nomina_up'])){
        $nom_complete_update=MysqlQuery::RequestPost('nom_nomina_up');
        $nom_nomina_update=MysqlQuery::RequestPost('nomina_up');
        $old_nom_nomina_update=MysqlQuery::RequestPost('old_nom_nomina_up');
        $pass_nomina_update=md5(MysqlQuery::RequestPost('nomina_clave_up'));
        $old_pass_nomina_uptade=md5(MysqlQuery::RequestPost('old_nomina_clave_up'));
        $email_nomina_update=MysqlQuery::RequestPost('nomina_email_up');

        $sql=Mysql::consulta("SELECT * FROM nomina WHERE nombre_nomina= '$old_nom_nomina_update' AND clave='$old_pass_nomina_uptade'");
        if(mysqli_num_rows($sql)>=1){
            if(MysqlQuery::Actualizar("nomina", "nombre_completo='$nom_complete_update', nombre_usuario='$nom_nomina_update', clave='$pass_nomina_update', email_nomina='$email_nomina_update'", "nombre_nomina='$old_nom_nomina_update' and clave='$old_pass_nomina_uptade'")){
                $_SESSION['nombre']=$nom_nomina_update;
                $_SESSION['clave']=$pass_nomina_update;
                echo '
                    <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">nomina ACTUALIZADO</h4>
                        <p class="text-center">
                            El nomina se actualizo con exito
                        </p>
                    </div>
                ';
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            No hemos podido actualizar el nomina
                        </p>
                    </div>
                ';
            }
        }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        Usuario y clave incorrectos
                    </p>
                </div>
            ';
       }
    }
    
    /*Script para eliminar cuenta*/
     if(isset($_POST['nom_nomina_delete']) && isset($_POST['nomina_clave__delete'])){
         $nom_nomina_delete=MysqlQuery::RequestPost('nom_nomina_delete');
         $clave_nomina_delete=md5(MysqlQuery::RequestPost('nomina_clave__delete'));
         $sql=Mysql::consulta("SELECT * FROM nomina WHERE nombre_nomina= '$nom_nomina_delete' AND clave='$clave_nomina_delete'");
         if(mysqli_num_rows($sql)>=1){
            if(MysqlQuery::Eliminar("nomina", "nombre_nomina='$nom_nomina_delete' and clave='$clave_nomina_delete'")){
                echo '<script type="text/javascript"> window.location="eliminar.php"; </script>';
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            No hemos podido eliminar el nomina
                        </p>
                    </div>
                ';
            }
         }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        Usuario y clave incorrectos
                    </p>
                </div>
            ';
         }
     }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <img src="./img/config.png" alt="Image" class="img-responsive">
        </div>
        <div class="col-sm-9">
          <p class="lead text-info">Bienvenido nomina, aqui podra agregar nuevos empleados, actualizar sus datos de cuenta y podra eliminar su cuenta si lo desea.</p>
        </div>
      </div><!--fin row-->
      
      <br><br>        
      
      <div class="row">
          <di class="col-sm-8">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="panel panel-success">
                    <div class="panel-heading text-center"><i class="fa fa-plus"></i>&nbsp;<strong>Agregar nuevo empleado</strong></div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                        <div class="form-group">
                          <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
                          <input type="text" class="form-control" name="nom_cliente_reg" placeholder="Nombre completo" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
                        </div>
                        <div class="form-group has-success has-feedback">
                          <label class="control-label"><i class="fa fa-user"></i>&nbsp;Usuario</label>
                          <input type="text" id="input_user" class="form-control" name="cliente_reg" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                          <div id="com_form"></div>
                        </div>
                        <div class="form-group">
                          <label><i class="fa fa-shield"></i>&nbsp;Contraseña</label>
                          <input type="password" class="form-control" name="cliente_clave_reg" placeholder="Contraseña" required="">
                        </div>
                        <div class="form-group">
                          <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                          <input type="email" class="form-control"  name="cliente_email_reg"  placeholder="Email " required="">
                        </div>

                        <div class="form-group">
                          <label><i class="fa fa-envelope"></i>&nbsp;Salario</label>
                          <input type="number" class="form-control"  name="cliente_salario_reg"  placeholder="Salario" required="">
                        </div>

                        <div class="form-group">
                          <label><i class="fa fa-envelope"></i>&nbsp;Cargo</label>
                          <input type="text" class="form-control"  name="cliente_cargo_reg"  placeholder="cargo" required="">
                        </div>

                            <center><button type="submit" class="btn btn-success">Agregar empleado</button></center>
                      </form>
                    </div>
                  </div>
                </div>  
              </div><!--Fin row 1 agregar-->
              
              <div class="row"> 
                  <div class="col-sm-12">
                    <div class="panel panel-danger">
                      <div class="panel-heading text-center"><i class="fa fa-trash-o"></i>&nbsp;<strong>Eliminar cuenta</strong></div>
                      <div class="panel-body">
                          <center><img class="img-responsive" src="./img/delete_user.png"></center><br>
                          <center><button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar cuenta</button></center>

                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">

                                     <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                       <h4 class="modal-title text-center text-danger" id="myModalLabel">¿Deseas eliminar tu cuenta?</h4>
                                    </div>
                                  <form action="" method="post" role="form" style="padding:20px;">
                                    <div class="input-group input-group-sm">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                      <input type="text" class="form-control" name="nom_nomina_delete" placeholder="Nombre de nomina" required="">
                                    </div><br>
                                    <div class="input-group input-group-sm">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                      <input type="password" class="form-control" name="nomina_clave__delete" placeholder="Contraseña" required="">
                                    </div><br>

                                    <center>
                                      <button type="submit" class="btn btn-danger btn-sm">Eliminar cuenta</button>
                                      <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancelar</button>
                                    </center>
                                  </form>

                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
                  </div> 
              </div><!--Fin row 2 eliminar-->
          </di><!--Fin class col-md-8-->
          
          <div class="col-sm-4">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="panel panel-info">
                     <div class="panel-heading text-center"><i class="fa fa-refresh"></i>&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                     <div class="panel-body">
                        <?php
                            $idad=$_SESSION['id'];
                            $sql1=Mysql::consulta("SELECT * FROM nomina WHERE id_nomina='$idad'");
                            $reg1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);
                        ?>
                         <form role="form" action="" method="POST">
                         <div class="form-group">
                           <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
                           <input type="text" class="form-control" value="<?php echo $reg1['nombre_completo']; ?>" name="nom_nomina_up" placeholder="Nombre completo" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
                         </div>

                         <div class="form-group has-success has-feedback">
                           <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nuevo nombre de nomina</label>
                           <input type="text" id="input_user2" class="form-control" name="nomina_up" placeholder="Nombre de nomina" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                           <div id="com_form2"></div>
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-shield"></i>&nbsp;Contraseña anterior</label>
                           <input type="password" class="form-control" name="old_nomina_clave_up" placeholder="Contraseña anterior" required="">
                         </div>
                             <div class="form-group">
                           <label><i class="fa fa-shield"></i>&nbsp;Nueva contraseña</label>
                           <input type="password" class="form-control" name="nomina_clave_up" placeholder="Nueva contraseña" required="">
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                           <input type="email" class="form-control" value="<?php echo $reg1['email_nomina']; ?>" name="nomina_email_up"  placeholder="Email nomina" required="">
                         </div><button type="submit" class="btn btn-info">Actualizar datos</button>
                       </form>
                     </div>
                   </div>
                   </div>
              </div><!--Fin row-->
          </div><!--Fin class col-md-4-->
      </div><!-- Fin row-->
      
    </div>
<?php
}else{
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
            <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
            
        </div>
        <div class="col-sm-7 animated flip">
            <h1 class="text-danger">Lo sentimos esta página es solamente para nominaes de LinuxStore</h1>
            <h3 class="text-info text-center">Inicia sesión como nomina para poder acceder</h3>
        </div>
        <div class="col-sm-1">&nbsp;</div>
    </div>
</div>
<?php
}
?>