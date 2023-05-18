<?php
// Cabecera del archivo PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="mi_archivo.pdf"');

// Datos para la tabla
$datos = array(
    array('ID', 'Nombre', 'Apellido'),
    array('1', 'John', 'Doe'),
    array('2', 'Jane', 'Smith'),
    array('3', 'Mike', 'Johnson')
);

// Crear el contenido del PDF
$pdfContent = "%PDF-1.3\n";
$pdfContent .= "1 0 obj\n";
$pdfContent .= "<< /Type /Catalog\n";
$pdfContent .= "   /Outlines 2 0 R\n";
$pdfContent .= "   /Pages 3 0 R >>\n";
$pdfContent .= "endobj\n";

$pdfContent .= "2 0 obj\n";
$pdfContent .= "<< /Type /Outlines\n";
$pdfContent .= "   /Count 0 >>\n";
$pdfContent .= "endobj\n";

$pdfContent .= "3 0 obj\n";
$pdfContent .= "<< /Type /Pages\n";
$pdfContent .= "   /Kids [4 0 R]\n";
$pdfContent .= "   /Count 1 >>\n";
$pdfContent .= "endobj\n";

$pdfContent .= "4 0 obj\n";
$pdfContent .= "<<  /Type /Page\n";
$pdfContent .= "    /Parent 3 0 R\n";
$pdfContent .= "    /Resources << /Font << /F1 5 0 R >> >>\n";
$pdfContent .= "    /Contents 6 0 R\n";
$pdfContent .= " >>\n";
$pdfContent .= "endobj\n";

$pdfContent .= "5 0 obj\n";
$pdfContent .= "<< /Type /Font\n";
$pdfContent .= "   /Subtype /Type1\n";
$pdfContent .= "   /BaseFont /Helvetica >>\n";
$pdfContent .= "endobj\n";

$pdfContent .= "6 0 obj\n";
$pdfContent .= "<< /Length 100 >>\n";
$pdfContent .= "stream\n";
$pdfContent .= "BT\n";
$pdfContent .= "/F1 12 Tf\n";
$pdfContent .= "70 400 Td\n";
$pdfContent .= "(Tabla de datos) Tj\n";
$pdfContent .= "ET\n";

// Obtener la posición inicial para la tabla
$posicionX = 70;
$posicionY = 350;
$alturaCelda = 20;
$anchoCelda = 80;

// Generar la tabla
// Generar la tabla
foreach ($datos as $fila) {
   $pdfContent .= "BT\n";
   $pdfContent .= "/F1 10 Tf\n";
   $pdfContent .= "{$posicionX} {$posicionY} Td\n";

   foreach ($fila as $celda) {
       // Dibujar el borde de la celda
       $pdfContent .= "{$posicionX} {$posicionY} {$anchoCelda} {$alturaCelda} re\n";
       $pdfContent .= "S\n";

       // Calcular la posición del texto centrado
       $longitudCelda = strlen($celda);
       $espacioDisponible = $anchoCelda - ($longitudCelda * 3); // Ajustar el factor "3" según el tamaño de la fuente
       $desplazamientoTextoX = $espacioDisponible / 2;
       $posicionTextoX = $posicionX + $desplazamientoTextoX;
       $posicionTextoY = $posicionY + ($alturaCelda / 2) - 5; // Ajustar el valor "-5" según el tamaño de la fuente

       // Mostrar el contenido de la celda centrado
       $pdfContent .= "BT\n";
       $pdfContent .= "{$posicionTextoX} {$posicionTextoY} Td\n";
       $pdfContent .= "2 Tr\n"; // Establecer la opción de alineación centrada
       $pdfContent .= "({$celda}) Tj\n"; // Mostrar el contenido centrado
       $pdfContent .= "ET\n";

       $posicionX += $anchoCelda;
   }

   $pdfContent .= "ET\n";

   $posicionX = 70;
   $posicionY -= $alturaCelda;
}




// Cerrar el contenido del PDF
$pdfContent .= "endstream\n";
$pdfContent .= "endobj\n";
$pdfContent .= "xref\n";
$pdfContent .= "0 7\n";
$pdfContent .= "0000000000 65535 f\n";
$pdfContent .= "0000000010 00000 n\n";
$pdfContent .= "trailer\n";
$pdfContent .= "<< /Size 7\n";
$pdfContent .= "   /Root 1 0 R\n";
$pdfContent .= ">>\n";
$pdfContent .= "startxref\n";
$pdfContent .= "213\n";
$pdfContent .= "%%EOF";

// Imprimir el contenido del PDF
// echo $pdfContent;
?>
