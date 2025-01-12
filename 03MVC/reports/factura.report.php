<?php
require("fpdf/fpdf.php");
require_once("../models/factura.model.php");
//----------------------------------------------------------------------------------------------------------------
$pdf = new FPDF();
$pdf->AddPage();
$factura = new Factura();


    $id = 1;
    //----------------------------------------------------------------------------------------------------------------
    $pdf->SetFont("Arial", "B", 12);
    
    //----------------------------------------------------------------------------------------------------------------
    $Factura  =  mysqli_fetch_assoc($factura->uno($id));
    //----------------------------------------------------------------------------------------------------------------


    $pdf->Cell(0, 10, "Empresa XYZ", 0, 1, 'L');
    $pdf->Cell(0, 10, "RUC: 1234567890", 0, 1, 'L');
    $pdf->Cell(0, 10, "Direccion: Calle Falsa 123, Quito, Ecuador", 0, 1, 'L');
    $pdf->Cell(0, 10, "Telefono: +593 999 999 999", 0, 1, 'L');
    $pdf->Cell(0, 10, "Email: info", 0, 1, 'L');
    
    //----------------------------------------------------------------------------------------------------------------
    $pdf->SetFont("Arial", "B", 14);
    $pdf->Cell(0, 10, "Factura No. 001-001-000000001", 0, 1, 'R');
    
    //----------------------------------------------------------------------------------------------------------------
    $pdf->SetFont("Arial", "", 12);
    $pdf->Cell(0, 10, "Fecha de Emision: " .$Factura["Fecha"], 0, 1, 'R');
    
    //----------------------------------------------------------------------------------------------------------------
    $pdf->Cell(0, 10, "Datos del Cliente", 0, 1, 'L');
    $pdf->Cell(0, 10, "Carlos Garcia", 0, 1, 'L');
    $pdf->Cell(0, 10, "Nombre: " . $Factura["Nombres"], 0, 1, 'L');
    $pdf->Cell(0, 10, "Cedula/RUC: 1234567890", 0, 1, 'L');
    $pdf->Cell(0, 10, "Direccion: Calle Ejemplo 456, Guayaquil, Ecuador", 0, 1, 'L');
    $pdf->Cell(0, 10, "Telefono: +593 987 654 321", 0, 1, 'L');
    
    //----------------------------------------------------------------------------------------------------------------
    $pdf->Ln(10);
    
    //----------------------------------------------------------------------------------------------------------------
    $pdf->SetFont("Arial", "B", 10);
    $pdf->Cell(40, 7, 'Descripcion', 1);
    $pdf->Cell(20, 7, 'Cantidad', 1);
    $pdf->Cell(40, 7, 'Precio Unitario', 1);
    $pdf->Cell(40, 7, 'Subtotal', 1);
    $pdf->Cell(20, 7, 'IVA (12%)', 1);
    $pdf->Cell(30, 7, 'Total', 1);
    $pdf->Ln();
    
    //----------------------------------------------------------------------------------------------------------------
    $productos = [
        ["Producto 1", 2, "$1,000.00", "$2,000.00", "$12.00", "$2,000.00"],
        ["Producto 2", 2, "$1,000.00", "$2,000.00", "$12.00", "$2,000.00"],
        ["Producto 3", 2, "$1,000.00", "$2,000.00", "$12.00", "$2,000.00"]
    ];
    
    foreach ($productos as $item) {
        $pdf->Cell(40, 7, $item[0], 1);
        $pdf->Cell(20, 7, $item[1], 1);
        $pdf->Cell(40, 7, $item[2], 1);
        $pdf->Cell(40, 7, $item[3], 1);
        $pdf->Cell(20, 7, $item[4], 1);
        $pdf->Cell(30, 7, $item[5], 1);
        $pdf->Ln();
    }
    
    //----------------------------------------------------------------------------------------------------------------
    if (isset($datosFacura["Sub_total"]) && isset($datosFacura["Sub_total_iva"]) && isset($datosFacura["Valor_IVA"])) {
    $pdf->Cell(80);
    $pdf->Cell(40, 7, 'Subtotal', 1);
    $pdf->Cell(40, 7, $Factura["Sub_total"], 1, 1);
    
    $pdf->Cell(80);
    $pdf->Cell(40, 7, 'SUB TOTAL IVA (15%)', 1);
    $pdf->Cell(40, 7, $Factura["Sub_total_iva"], 1, 1);
    
    $pdf->Cell(80);
    $pdf->Cell(40, 7, 'IVA (15%)', 1);
    $pdf->Cell(40, 7, $Factura["Valor_IVA"], 1, 1);
    
    $pdf->Cell(80);
    $pdf->Cell(40, 7, 'Total a Pagar', 1);
    $pdf->Cell(40, 7, '141.45', 1, 1);
    }
    
    //----------------------------------------------------------------------------------------------------------------
    $pdf->Ln(10);
    $pdf->Cell(0, 10, "Forma de pago: Transferencia Bancaria", 0, 1, 'C');
    $pdf->Cell(0, 10, "Cuenta Bancaria: Banco Pichincha, Cta: 123456789", 0, 1, 'C');
    $pdf->Cell(0, 10, "Nota: Gracias por su compra.", 0, 1, 'C');
    
    //----------------------------------------------------------------------------------------------------------------
    $pdf->Output();

    
