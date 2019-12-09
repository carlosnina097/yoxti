<!DOCTYPE html>
<html>
  <head>
    <title>Registrar Donaciones</title>
    <!-- This means that the browser will render the width of the page at the width of its own screen. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.css" rel="stylesheet" media="screen">
    <link href="css/my-styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/style-responsive.css" />
    <style>
      table {
          width:100%;
      }
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
      }
      th, td {
          padding: 5px;
          text-align: center;
      }
      table#t01 tr:nth-child(even) {
          background-color: #eee;
      }
      table#t01 tr:nth-child(odd) {
         background-color:#fff;
      }
      table#t01 th {
          background-color: black;
          color: white;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <!-- Include a container inside of our navbar so the container will span the same width of the content -->
      <div class="container">

        <!-- navbar-toggle positions the toggle button over to the right side of the navbar in mobile views. -->
        <!-- Data-toggle attribute is a custom data attribute that calls the collapse JS plugin functions -->
        <!-- Data-target attribute id what makes the nav toggle on and off -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        

        <!-- brand will let bootstrap to place it over to the left side of the navigation. text-muted don't let text stand out -->
        <a class="navbar-brand text-muted" href="main.html">Widget - Prueba</a>
        </div>
        <div class="collapse navbar-collapse">

          <!-- navbar positions the navigation links horizontally and gives them their default color styles. -->
          <ul class="nav navbar-nav navbar-right">
            <li class="active dropdown">
              <a data-toggle="dropdown" data-target="cliente.html">Clientes<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="cliente.php">Registrar Clientes</a></li>
                <li><a href="cliente_list.php">Ver Clientes</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a data-toggle="dropdown" data-target="proyecto.html">Proyectos<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="proyecto.php">Registrar Proyecto</a></li>
                <li><a href="proyecto_list.php">Ver Proyectos</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a data-toggle="dropdown" data-target="empresa.html">Empresas<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="empresa.php">Registrar Empresa</a></li>
                <li><a href="empresa_list.php">Ver Empresas</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a data-toggle="dropdown" data-target="donacion.html">Donaciones<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="donacion.php">Registrar Donación</a></li>
                <li><a href="donacion_list.php">Ver Donaciones</a></li>
              </ul>
            </li>

          </ul>

        </div>
      </div>
    </div>
    <!-- End navbar -->



    <!-- container class inside Bootstrap can center the page content and it also sets the containers max width at every media query break point. -->
    <div class="container documentationbar">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-lg-9">
        
          <div class="jumbotron">
            <form method= "post" action="">
              <?php
                  include 'inc/connection.php';
                  //session_start();
                  $IDProyecto = isset($_REQUEST['IDProyecto']) ? (int)trim($_REQUEST['IDProyecto']): "";
                  $IDEmpresa = isset($_REQUEST['IDEmpresa']) ? (int)trim($_REQUEST['IDEmpresa']): "";
                  $IDCliente = isset($_REQUEST['IDCliente']) ? (int)trim($_REQUEST['IDCliente']): "";
                  $Importe = isset($_REQUEST['Importe']) ? (Double)trim($_REQUEST['Importe']): "";
                  $Fecha_Donacion = new DateTime();
                  $Fecha_Donacion = date_format($Fecha_Donacion,('Y-m-d H:i:s'));
                  $values="";
          
                  if (isset($_POST['RegistrarDonacion'])) {
                    
                    if (!$IDProyecto || !$IDEmpresa || !$IDCliente || !$Importe || !$Fecha_Donacion ) {

                     print "<div class='jumbotron'><h4>Es necesario completar todos los campos</h4></div>";
                      //echo($NombreCliente.' '.$ApellidoCliente.' '.$Correo.' '.$Nacimiento.' '.$DNI.' '.$Indicador.' '.$Token.' '.$Imagen. ' '.$Fecha_Registro); 

                    } else {

                      if (!$IDProyecto) {
                        print "<div class='jumbotron'><h4>Ingrese un valor correcto para el nombre</h4></div>";
                      } else {
                        $values = "$IDProyecto";                       
                      }
            
                      if (!$IDEmpresa) {
                        print "<div class='jumbotron'><h4>Ingrese un valor correcto para la descripcion</h4></div>";
                      } else {
                        $values = $values.",$IDEmpresa";
                      }

                      if (!$IDCliente) {
                        print "<div class='jumbotron'><h4>Ingrese un valor correcto para la fecha de inicio</h4></div>";
                      } else {
                      $values = $values.",$IDCliente";
                      }

                      if (!$Importe) {
                        print "<div class='jumbotron'><h4>Ingrese un valor correcto para la fehca de fin</h4></div>";
                      } else {
                      $values = $values.",$Importe";
                      }

                      if (!$Fecha_Donacion) {
                        print "<div class='jumbotron'><h4>Ingrese un valor correcto para el monto meta</h4></div>";
                      } else {
                      $values = $values.",'$Fecha_Donacion'";
                      }

                      if ( !$IDProyecto || !$IDEmpresa || !$IDCliente || !$Importe || !$Fecha_Donacion ) {
                      print "<div class='jumbotron'><h4>VALIDACION </h4></div>";
                      } else {
                        $query = "INSERT into donacion (id_proyecto,id_empresa,id_cliente,importe_donacion,fecha_donacion)
                                VALUES (".$values.")";
                        if (mysqli_query($dbcon, $query)) {
                          print "<div class='jumbotron'><h4>Se ha registrado la nueva donacion correctamente.</h4></div>";

                        } else {
                          echo $values;
                          die('Query failed: ' . mysqli_error($dbcon));
                        }
                      }
                    }
                  }

              ?>
              <fieldset>
                <legend>Registrar Donacion: </legend>
                <label for="IDProyecto">Proyecto: </label>
                <select id="IDProyecto" name="IDProyecto" >
                <option selected="selected">Elegir un proyecto</option>
                <?php

                $Query = "select id_proyecto,nombre_proyecto from proyecto";
                $proyectos = mysqli_query($dbcon, $Query) or die('Query failed: ' . mysqli_error($dbcon));
                                
                foreach ($proyectos as $item){
                ?>
                <option value="<?php echo $item['id_proyecto']; ?>"><?php echo $item['nombre_proyecto']; ?></option>
                <?php
                }
                ?>
                </select>

                 <label for="IDEmpresa">Empresa: </label>
                <select id="IDEmpresa" name="IDEmpresa" >
                <option selected="selected">Elegir una empresa</option>
                <?php

                $Query = "select id_empresa,nombre_empresa from empresa";
                $empresas = mysqli_query($dbcon, $Query) or die('Query failed: ' . mysqli_error($dbcon));
                                
                foreach ($empresas as $item){
                ?>
                <option value="<?php echo $item['id_empresa']; ?>"><?php echo $item['nombre_empresa']; ?></option>
                <?php
                }
                ?>
                </select>

                <label for="IDCliente">Cliente: </label>
                <select id="IDCliente" name="IDCliente" >
                <option selected="selected">Elegir un cliente</option>
                <?php

                $Query = "select id_cliente,nombres_cliente from cliente";
                $clientes = mysqli_query($dbcon, $Query) or die('Query failed: ' . mysqli_error($dbcon));
                                
                foreach ($clientes as $item){
                ?>
                <option value="<?php echo $item['id_cliente']; ?>"><?php echo $item['nombres_cliente']; ?></option>
                <?php
                }
                ?>
                </select>

                <label for="Importe">Importe: </label><br>
                <input type="number" step="any" id="Importe" name="Importe"><br>

                <input type="submit" value="Registrar Donacion" name="RegistrarDonacion">
              </fieldset>
            </form>

            <!-- <form method= "post" action="">
              <?php
                  include 'inc/connection.php';
                  //session_start();
                  $UpdatePlayerName = isset($_REQUEST['UpdatePlayerName']) ? (String)trim($_REQUEST['UpdatePlayerName']):"";
                  $UpdatePlayerCountry = isset($_REQUEST['UpdatePlayerCountry']) ? (String)trim($_REQUEST['UpdatePlayerCountry']):"";
                  $UpdatePlayerPosition = isset($_REQUEST['UpdatePlayerPosition']) ? trim($_REQUEST['UpdatePlayerPosition']): "";
                  $UpdatePlayerAge = isset($_REQUEST['UpdatePlayerAge'])?(int)trim($_REQUEST['UpdatePlayerAge']):"";

                  if (isset($_POST['ModifyPlayer'])) {

                    if (!$UpdatePlayerName || ctype_digit($UpdatePlayerName)) {
                      print "<div class='jumbotron'><h4>Please enter a valid player name</h4></div>";
                    } else {
                      $tempQuery = "SELECT player_id from player where player_name = '$UpdatePlayerName'";

                      $search = mysqli_query($dbcon, $tempQuery) or die('Query failed: ' . mysqli_error($dbcon));
                      $tuple = mysqli_fetch_assoc($search);
                      $PlayerID = $tuple['player_id'];

                      if (!$PlayerID) {
                        print "<div class='jumbotron'><h4>The player you want to update doesn't exist in the database!</h4></div>";
                      } else {

                        if (!$UpdatePlayerCountry && !$UpdatePlayerPosition && !$UpdatePlayerAge) {
                          print "<div class='jumbotron'><h4>Please enter updated attribute value. No update occurs!</h4></div>";
                        } else if (ctype_digit($UpdatePlayerCountry)) {
                          print "<div class='jumbotron'><h4>Please enter a valid string value for player's country!</h4></div>";
                        } else if (!is_int($UpdatePlayerAge)) {
                          print "<div class='jumbotron'><h4>Please enter an integer value for player's age!</h4></div>";
                        } else {
                          if ($UpdatePlayerCountry) {
                            $attribute = "country = '".$UpdatePlayerCountry."'";
                          }
                          if ($UpdatePlayerPosition) {
                            if ($attribute) {
                              $attribute = $attribute.",position = '".$UpdatePlayerPosition."'";
                            } else {
                              $attribute = "position = '".$UpdatePlayerPosition."'";
                            }
                          }
                          if ($UpdatePlayerAge) {
                            if ($UpdatePlayerAge >= 15 && $UpdatePlayerAge <= 40) {
                              if ($attribute) {
                                $attribute = $attribute.",age = ".$UpdatePlayerAge;
                              } else {
                                $attribute = "age = ".$UpdatePlayerAge;
                              }
                            } else {
                              print "<div class='jumbotron'><h4>Please enter an valid integer value between 15 and 40 inclusive for player age</h4></div>";
                            }
                            
                          }

                          if ($attribute) {
                            $query = "UPDATE player SET ".$attribute." where player_name = '$UpdatePlayerName'";

                            if (mysqli_query($dbcon, $query)) {
                              print "<div class='jumbotron'><h4>This player's record was updated successfully!</h4></div>";
                            } else {
                              die('Query failed: ' . mysqli_error($dbcon));
                            }
                          }
                        }
                      }
                    }
                  }
              ?>
              <fieldset>
                <legend>Update Player:</legend>
                <label for="lplayername">Please enter the player that you want to modify: (Ex: Paul Pogba)</label>
                <input type="text" id="updateplayername" name="UpdatePlayerName" >
                <br>

                <legend>Enter the attribute value that you want to update:</legend>
                <label for="lcountry">Country (Ex: Spain)</label>
                <input type="text" id="updatecountryname" name="UpdatePlayerCountry">

                <label for="position">Position</label>
                <select id="updateposition" name="UpdatePlayerPosition" >
                  <option value=""></option>
                  <option value="Goalkeeper">Goalkeeper</option>
                  <option value="Defender">Defender</option>
                  <option value="Midfielder">Midfielder</option>
                  <option value="Forward">Forward</option>
                </select>

                <label for="age">Age</label>
                <input type="number" id="updateplayerage" name="UpdatePlayerAge">
              
                <input type="submit" value="Modify Player" name="ModifyPlayer">
              </fieldset>
            </form> -->

           <!--  <form method= "post" action="">
              <?php
                  include 'inc/connection.php';
                  //session_start();
                  $DeletePlayerName = isset($_REQUEST['DeletePlayerName'])? (String)trim($_REQUEST['DeletePlayerName']):"";

                  if (isset($_POST['DeletePlayer'])) {

                    if (!$DeletePlayerName || ctype_digit($DeletePlayerName)) {
                      print "<div class='jumbotron'><h4>Please enter a valid player name</h4></div>";
                    } else {
                      $tempQuery = "SELECT player_id from player where player_name = '$DeletePlayerName'";

                      $search = mysqli_query($dbcon, $tempQuery) or die('Query failed: ' . mysqli_error($dbcon));
                      $tuple = mysqli_fetch_assoc($search);
                      $PlayerID = $tuple['player_id'];

                      if (!$PlayerID) {
                        print "<div class='jumbotron'><h4>The player you want to remove doesn't exist in the database!</h4></div>";
                      } else {
                        $query = "DELETE from player where player_name = '$DeletePlayerName'";
                        if (mysqli_query($dbcon, $query)) {
                          print "<div class='jumbotron'><h4>This player's record removed successfully!</h4></div>";
                        } else {
                          die('Query failed: ' . mysqli_error($dbcon));
                        }
                      }
                    }
                  }
              ?>
              <fieldset>
                <legend>Delete Player:</legend>
                <label for="lplayername">Please enter the player that you want to delete</label>
                <input type="text" id="deleteplayername" name="DeletePlayerName">
              
                <input type="submit" value="Delete Player" name="DeletePlayer">
              </fieldset>
            </form> -->

          </div>

        </div><!--/.col-xs-12.col-sm-9-->

      </div><!--/row-->
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>