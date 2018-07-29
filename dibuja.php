<?php require_once('Astar1.php'); ?>
<script type="text/javascript">
var cantidadDeNodos = <?php echo $cantidadDeNodos ?>;

var canvas = document.getElementById("lienzoprincipal");
var ctx = canvas.getContext("2d");

<?php for($i=0; $i< $cantidadDeNodos ;$i++): ?>
	ctx.beginPath();
	ctx.arc(<?php echo $mapa[$i]->obtenerEjeX(); ?>,<?php echo $mapa[$i]->obtenerEjeY(); ?>,5, 0, 2 * Math.PI);
	ctx.font = "bold 15px sans-serif";
	ctx.fillText(<?php echo $mapa[$i]->obtenerNombre(); ?>,<?php echo $mapa[$i]->obtenerEjeX(); ?>-2,<?php echo $mapa[$i]->obtenerEjeY(); ?>-5);
	ctx.stroke();
<?php endfor; ?>
</script>