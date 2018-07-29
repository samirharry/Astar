<script>
    var canvas = document.getElementById("lienzoprincipal");
    var ctx = canvas.getContext("2d");
    function pintaVerde(x,y){
        ctx.beginPath();
        ctx.fillStyle = "rgb(0,255,0)";
	    ctx.arc(x,y,5, 0, 2 * Math.PI);
        ctx.fill();
	    ctx.stroke();
    };
</script>
<?php
require_once('Astar1.php');
function Astar(Vertice $inicio,Vertice $final) {
    $listaAbierta = array();
    $listaCerrada = array();
    $inicio->g=0;
    $inicio->h = $inicio->distancia($final);
    $inicio->f = $inicio->g+$inicio->h;
    $listaAbierta[]=$inicio;
    $destinoencontrado=false;
    while(count($listaAbierta) !=0 && !$destinoencontrado){
        $indmin=0;
        $minaux=$listaAbierta[$indmin]->f;
        for($i=0 ;$i<count($listaAbierta);$i++){
            if($minaux>=$listaAbierta[$i]->f){
                $indmin=$i;
                $minaux=$listaAbierta[$i]->f;
            }
        }
        $q=$listaAbierta[$indmin];
        array_splice($listaAbierta,$indmin,1);
        $vecinosaux=$q->obtenerVecinos();
        for($i=0;$i<count($vecinosaux);$i++){
            $nuevog;
            $nuevoh;
            $nuevof;
            if ($vecinosaux[$i] === $final) {
                $vecinosaux[$i]->parent=$q;
                $destinoencontrado = true;
                break;
            }
            else if(!in_array($vecinosaux[$i],$listaCerrada,true)){
                $nuevog = $q->g+$q->distancia($vecinosaux[$i]);
                $nuevoh = $vecinosaux[$i]->distancia($final);
                $nuevof = $nuevog + $nuevoh;
                if(!in_array($vecinosaux[$i],$listaAbierta,true)){
                    $vecinosaux[$i]->g=$nuevog;
                    $vecinosaux[$i]->h=$nuevoh;
                    $vecinosaux[$i]->f=$nuevof;
                    $vecinosaux[$i]->parent=$q;
                    $listaAbierta[]=$vecinosaux[$i];
                }
                else if($vecinosaux[$i]->f > $nuevof){
                    $vecinosaux[$i]->g=$nuevog;
                    $vecinosaux[$i]->h=$nuevoh;
                    $vecinosaux[$i]->f=$nuevof;
                }
            }
          
        }
        $listaCerrada[]=$q;
    }
    $ruta=array();
    $aux = $final;
    $ruta[]=$aux;
    $xa = $aux->obtenerEjeX();
    $ya = $aux->obtenerEjeY();
    echo "<script type='text/javascript'>";
    echo "pintaVerde(".$xa.",".$ya.");";
    echo "</script> ";
    while($aux!=$inicio){
        $aux=$aux->parent;
        $xa = $aux->obtenerEjeX();
        $ya = $aux->obtenerEjeY();
        echo "<script type='text/javascript'>";
        echo "pintaVerde(".$xa.",".$ya.");";
        echo "</script> ";
        $ruta[]=$aux;
    }
    return $ruta;
}


$start =$mapa[$_POST['start']-1];
$final = $mapa[$_POST['end']-1];
$rutAstar= array_reverse(Astar($start,$final));
?>
<script type="text/javascript">
    ctx.lineWidth = 5;
    ctx.strokeStyle = "#f00";
    ctx.beginPath();
    ctx.lineCap="round";
    ctx.moveTo(<?php echo $rutAstar[0]->obtenerEjeX()?>,<?php echo $rutAstar[0]->obtenerEjeY()?>);
    <?php for($i=0; $i< count($rutAstar) ;$i++): ?>
        ctx.lineTo(<?php echo $rutAstar[$i]->obtenerEjeX()?>,<?php echo $rutAstar[$i]->obtenerEjeY()?>);
    <?php endfor; ?>
    ctx.stroke();
</script>