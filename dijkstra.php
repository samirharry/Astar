<?php
require_once('Astar1.php');
function dijkstra(vertice $inicio, vertice $final) {
    $destinoencontrado=false;
    $inicio->padredijk=NULL;
    $inicio->dijkd =0;
    $inicio->marcado=true;
    $vecinaux=$inicio->obtenerVecinos();
    $visitados = array();
    $visitados[]=$inicio;
    for($i=0;$i<count($vecinaux);$i++){
       if($vecinaux[$i]===$final) {
           $destinoencontrado = true;
           $vecinaux[$i]->padredijk=$inicio;
           break;
        }
        $vecinaux[$i]->padredijk=$inicio;
        $vecinaux[$i]->dijkd= $inicio->dijkd+$vecinaux[$i]->distancia($inicio);
        $visitados[]=$vecinaux[$i];    
    }
    while(!$destinoencontrado){
        $minaux=INF;
        $indmin;
        for($i=0;$i<count($visitados);$i++){
            if($visitados[$i]->dijkd<=$minaux && !$visitados[$i]->marcado){
                $indmin=$i;
                $minaux=$visitados[$i]->dijkd;
            }
        }
        $visitados[$indmin]->marcado=true;
        $p=$visitados[$indmin];
        $vecinauxil=$p->obtenerVecinos();
        for($i=0;$i<count($vecinauxil);$i++){
            if($vecinauxil[$i]===$final) {
                $vecinauxil[$i]->padredijk=$p;
                $destinoencontrado = true;
                break;
            }
            if($vecinauxil[$i]->marcado){
                continue;
            }
            $distaux=$p->dijkd+$vecinauxil[$i]->distancia($p);
            if($distaux<=$vecinauxil[$i]->dijkd) {
                $vecinauxil[$i]->dijkd=$distaux;
                $vecinauxil[$i]->padredijk=$p;
            }
            $visitados[]=$vecinauxil[$i];
        }
    }
    $ruta=array();
    $aux = $final;
    $ruta[]=$aux;
    while($aux!=$inicio){
        $aux = $aux->padredijk;
        $ruta[]=$aux;
    }
    return $ruta;
}

$startdijk =$mapa[$_POST['start']-1];
$finaldijk = $mapa[$_POST['end']-1];
$rutDijk= array_reverse(dijkstra($startdijk,$finaldijk));
?>
<script type="text/javascript">
ctx.lineWidth = 3;
ctx.strokeStyle = "rgba(0,255,255)";
ctx.beginPath();
ctx.moveTo(<?php echo $rutDijk[0]->obtenerEjeX()?>,<?php echo $rutDijk[0]->obtenerEjeY()?>);
<?php for($i=0; $i< count($rutDijk) ;$i++): ?>
ctx.lineTo(<?php echo $rutDijk[$i]->obtenerEjeX()?>,<?php echo $rutDijk[$i]->obtenerEjeY()?>);
<?php endfor; ?>
ctx.stroke();

</script>
