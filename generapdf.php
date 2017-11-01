<?php
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
class PDF extends FPDF{
}

    $link=mysql_connect("localhost","root","");
        if($link){
            mysql_select_db("usuarios",$link);
        }

//siempre revisen si se realizan las conexiones, se ejecutan los sql etc.
if (!$link) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL."<br>";
    echo "error de depuración:  " . mysqli_connect_errno() . PHP_EOL."<br>";
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL."<br>";
    exit;
}

$consulta=mysql_query("SELECT * FROM calificaciones WHERE nocontrol = 12141368")or die(mysql_error());


if ($sentencia = mysqli_prepare($link, $consulta)) {
    /* ejecutar la sentencia */
   if(!mysqli_stmt_execute($sentencia)) echo "error 1";
    /* vincular las variables de resultados */
    if(!mysqli_stmt_bind_result($sentencia, $nombre_largo, $id_usuario, $calificacion, $descripcion)) echo "error 2".mysqli_error($link);;
    mysqli_stmt_store_result($sentencia);
    /* obtener los valores */
    
    $cuantos= mysqli_stmt_num_rows($sentencia);	
    if($cuantos>0){
    	$pdf->SetFont('Arial','B',12);
    	$pdf->Cell(70,8,utf8_decode("Nombre del Alumno"),"1");
    	$pdf->Cell(50,8,utf8_decode("Materia"),"1");
		$pdf->Cell(10,8,"Calificación","1",1,"C");
   		 while (mysqli_stmt_fetch($sentencia)) {
    		$pdf->SetFont('Arial','B',12);
    		
			$pdf->Cell(70,8,utf8_decode($nombre_largo),"1");
			$pdf->Cell(50,8,utf8_decode($descripcion),"1");
			$pdf->Cell(10,8,$calificacion,"1",0,"C");
			$pdf->ln(8);
		}
	}
	else{
			$pdf->SetFont('Arial','B',18);
			$pdf->Cell(70,20,utf8_decode("no hay registros"),"1");
		}
    /* cerrar la sentencia */
    mysqli_stmt_close($sentencia);
    $pdf->Output();
} else {
	echo "No se pudo ejecutar la sentencia";
}
mysqli_close($enlace);
?>