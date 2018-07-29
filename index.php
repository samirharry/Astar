<!doctype html>
<html lang="es">
  <head>
    <title>Dijkstra algoritm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  </head>
  <body style="background: rgba(255, 240, 201)">
    <h1 style="text-align: center" >
	HOLA BIENVENIDO A SAMIRHARRY.COM
	</h1>
    <h1 style="text-align: center" >
        EL SIGUIENTE PROGRAMA TE AYUDARA A ENCONTRAR LA RUTA MAS CORTA ENTRE 2 PUNTOS EN UN MAPA
    </h1>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <canvas id="lienzoprincipal" width="708" height="485" style="background-image: url('img/mapa4.png');border-style:double ;border-width:2px;text-align: center;" ></canvas> 
            <?php require('dibuja.php');?> 
            <h1 class="page-header">Ruta mas corta</h1>
            <form method="POST" action="index.php">
                <div class="form-group">
                    <label>Punto Inicial</label>
                    <input type="text"name="start" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Punto Final</label>
                    <input type="text"name="end" class="form-control"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" >Enviar</button> 
                </div>
            </form>
        </div>

        <?php require('ast.php');?>
        <div class="col-lg-1"></div> 
        <div class="col-lg-3">
            <?php
            $table = "<table class='table-striped' border='1'>";
            $table .= "<tr>";
            $table .= "<th scope='row' style='text-align: center;font-size: 30px'>N°</th>";
            $table .= "<th style='text-align: center;font-size: 30px'>Nodos a visitar para ir de ";
            $table .= $rutAstar[0]->nombre;
            $table .= " a ";
            $table .= $rutAstar[count($rutAstar)-1]->nombre;
            $table .= "</th>";
            $table .= "</tr>";
            $table .= "<tr>";
            $table .= "<td ";
            $table .= "style='text-align: center; font-size: 30px;'>INICIO</td>";                
            $table .= "<td ";
            $table .= "style='text-align: center; font-size: 30px;'>";
            $table .= $rutAstar[0]->nombre;
            $table .= "</td>";
            $table .= "</tr>";
            $ind=0;
            for($i=1;$i<count($rutAstar)-1;$i++){
                $table .= "<tr>";
                $table .= "<td ";
                $table .= "style='text-align: center; font-size: 30px;'>";
                $table .= ++$ind;
                $table .= "</td>";                
                $table .= "<td ";
                $table .= "style='text-align: center; font-size: 30px;'>";
                $table .= $rutAstar[$i]->nombre;
                $table .= "</td>";
                $table .= "</tr>";
            } 
            $table .= "<tr>";
            $table .= "<td ";
            $table .= "style='text-align: center; font-size: 30px;'>FINAL</td>";                
            $table .= "<td ";
            $table .= "style='text-align: center; font-size: 30px;'>";
            $table .= $rutAstar[count($rutAstar)-1]->nombre;
            $table .= "</td>";
            $table .= "</tr>"; 

            $table .= "<table border='0'>";

            echo $table;
            ?>

        </div>
    </div>

  </body>
     
</html>