<?php
//require "vendor/autoload.php";
//$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
//$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
//$redColor = [255, 0, 0];
//
//echo '<img src="data:image/png;base64,' . base64_encode($generatorPNG->getBarcode('081231723897', $generatorPNG::TYPE_CODE_128)) . '">';
//
//$generatorJPG = new Picqer\Barcode\BarcodeGeneratorJPG();
//file_put_contents('barcode.jpg', $generatorJPG->getBarcode('081231723897', $generatorJPG::TYPE_CODABAR));
//
//include('serverconnect.php');
//$getbarcode = mysqli_query($db,"select * from equipment");
//
//while ($row = mysqli_fetch_array($getbarcode)){
//    $equipment_name = $row['equipment'];
//    echo $equipment_name;
//    echo $generator->getBarcode($row['id'], $generator::TYPE_CODE_128);
//}
//

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();