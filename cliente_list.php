<!DOCTYPE html>
<html>
  <head>
    <title>Listar Clientes</title>
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

          <div class="row">
            <div class="col-xs-12 col-lg-12">
              <form method="get" action="">
                <h5>Páginas: </h5>
                <table id="t01">
                  <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Correo</th>
                    <th>DNI</th>
                    <th>Imagen</th>
                  </tr>
                <?php
                include 'inc/connection.php';
                //session_start();

                $rec_limit = 10;
                $page=isset($_GET["page"])?$_GET["page"]:"";
                if ($page=="" || $page=="1") {
                  $page1 = 0;
                } else {
                  $page1 = ($page*10)-10;
                }
                $query = "SELECT c.nombres_cliente,c.apellidos_cliente, c.fecha_nacimiento, c.correo_cliente, c.dni_cliente, c.imagen_cliente FROM cliente c limit $page1, 10";
                          $result = mysqli_query($dbcon, $query)
                  or die('Query failed: ' . mysqli_error($dbcon)); 
                $totalItem = 0;
                while ($tuple = mysqli_fetch_assoc($result)) {
                  print '<tr><td>'.$tuple['nombres_cliente'].'</td>
                  <td>'.$tuple['apellidos_cliente'].'</td>
                  <td>'.$tuple['fecha_nacimiento'].'</td>
                  <td>'.$tuple['correo_cliente'].'</td>
                  <td>'.$tuple['dni_cliente'].'</td>
                  <td>'.$tuple['imagen_cliente'].'</td></tr>';
                  $totalItem += 1;
                }

                if ($totalItem < 1) {
                  print "<div class='jumbotron'><h4>No existen Cientes</h4></div>";
                  //"<p>Search Results: Not Found. Please modify your condition!</p>";
                }
                

                $p = $totalItem/10;
                $p = ceil($p);

                for ($b=1;$b<=$p;$b++) {
                  ?><a href="cliente_list.php?page=<?php echo $b; ?>&cc="><?php echo $b." "; ?></a><?php
                }
                echo "<br>";

                ?>
                </table>
                <br>
                <br>
              </form>
              
            </div><!--/.col-xs-6.col-lg-4-->
          
          </div><!--/row-->

        </div><!--/.col-xs-12.col-sm-9-->

      </div><!--/row-->
    </div>






    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>