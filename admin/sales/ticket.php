<?php 
	require '../../fpdf182/fpdf.php';
	require ('../db_connect.php');
	
class PDF_EAN13 extends FPDF
{
function EAN13($x, $y, $barcode, $h=16, $w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,13);
}

function UPC_A($x, $y, $barcode, $h=16, $w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,12);
}

function GetCheckDigit($barcode)
{
    //Compute the check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode[$i];
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode[$i];
    $r=$sum%10;
    if($r>0)
        $r=10-$r;
    return $r;
}

function TestCheckDigit($barcode)
{
    //Test validity of check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode[$i];
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode[$i];
    return ($sum+$barcode[12])%10==0;
}

function Barcode($x, $y, $barcode, $h, $w, $len)
{
    //Padding
    $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
    if($len==12)
        $barcode='0'.$barcode;
    //Add or control the check digit
    if(strlen($barcode)==12)
        $barcode.=$this->GetCheckDigit($barcode);
    elseif(!$this->TestCheckDigit($barcode))
        $this->Error('Incorrect check digit');
    //Convert digits to bars
    $codes=array(
        'A'=>array(
            '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
            '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
        'B'=>array(
            '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
            '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
        'C'=>array(
            '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
            '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
        );
    $parities=array(
        '0'=>array('A','A','A','A','A','A'),
        '1'=>array('A','A','B','A','B','B'),
        '2'=>array('A','A','B','B','A','B'),
        '3'=>array('A','A','B','B','B','A'),
        '4'=>array('A','B','A','A','B','B'),
        '5'=>array('A','B','B','A','A','B'),
        '6'=>array('A','B','B','B','A','A'),
        '7'=>array('A','B','A','B','A','B'),
        '8'=>array('A','B','A','B','B','A'),
        '9'=>array('A','B','B','A','B','A')
        );
    $code='101';
    $p=$parities[$barcode[0]];
    for($i=1;$i<=6;$i++)
        $code.=$codes[$p[$i-1]][$barcode[$i]];
    $code.='01010';
    for($i=7;$i<=12;$i++)
        $code.=$codes['C'][$barcode[$i]];
    $code.='101';
    //Draw bars
    for($i=0;$i<strlen($code);$i++)
    {
        if($code[$i]=='1')
            $this->Rect($x+$i*$w,$y,$w,$h,'F');
    }
    //Print text uder barcode
    $this->SetFont('Arial','',12);
    $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
}
}


$id_venta = $_GET['id'];
// $pdf = new FPDF();
$pdf=new PDF_EAN13();
$pdf->AddPage();

/*DATOS DE LA EMPRESA*/
$pdf->Image('../logo.jpg',5,5,70);


$pdf->SetFont('Arial','B',10);
$pdf->text(80,10,'Domicilio:');
$pdf->text(105,10,'Puerto Guaymas 90A, Colonia Miramar, Zapopan, Jal.');
$pdf->text(80,15,'Numero:');
$pdf->text(105,15,'3316529357');
$pdf->text(130,15,'CP: 45060');
$pdf->text(80,20,'R.F.C: DSM151121R70');

/////////////////////

$conn = conecta();
$query = "SELECT * FROM ventas WHERE id = '$id_venta'";
$res = mysqli_query($conn,$query);
$reg = mysqli_fetch_array($res);

$pdf->text(80,30,'Fecha: '.$reg[3]);
if($reg[2]==0)
{
	$cliente = "No aplica";
	$correo = "No aplica";
}
else
{
	$query_customer = "SELECT * FROM clientes WHERE id = '$reg[2]'";
	$customer_res = mysqli_query($conn,$query_customer);
	$reg_customer = mysqli_fetch_array($customer_res);
	$cliente = $reg_customer[1]." ".$reg_customer[2];
	$correo = $reg_customer[3];
}
$pdf->Line(5,45,205,45);
$pdf->text(2,50,'Cliente: '.$cliente);
$pdf->text(2,55,'Correo: '.$correo);
// $pdf->text(100,50,'Telefono:45060');
// $pdf->text(100,55,'R.F.C:SAPE960703DY6');
$pdf->Line(0,65,210,65);
$pdf->SetTitle('Pago Drone Shadow ');

$pdf->SetFont('Arial','B',12);
 $pdf->text(2,70,'Cantidad');
 $pdf->text(30,70,'Nombre');
 $pdf->text(60,70,'Descripcion');
 $pdf->text(150,70,'Precio');
 $pdf->text(180,70,'Importe');
 $y =  80;
 $total = 0;
$pdf->SetFont('Arial','B',8);
// $pdf->text(2,55,'Correo: '.$correo);
$query_detalle = "SELECT * FROM detalle_venta WHERE id_venta = '$id_venta'";
$detalle_res = mysqli_query($conn,$query_detalle);
$rows = mysqli_num_rows($detalle_res);

for ($i = 0; $i <$rows ; $i++){
	 mysqli_data_seek($detalle_res,$i);
	 $reg = mysqli_fetch_row($detalle_res);

	 $prod_query = "SELECT * FROM productos WHERE id = '$reg[1]'";
	 $prod_query_res = mysqli_query($conn,$prod_query);
	 $prod_reg = mysqli_fetch_array($prod_query_res);
	$pdf->text(2,$y,$reg[2]);
	$pdf->text(30,$y,$prod_reg[1]);
	$pdf->text(60,$y,$prod_reg[3]);
	$pdf->text(150,$y,$prod_reg[4]);
	$pdf->text(180,$y,$prod_reg[4]*$reg[2]);
	$y+=10;
	$total += $prod_reg[4]*$reg[2];

}
// $code = "";

$pdf->EAN13(5,275,'123456789012',12,.6);
$pdf->text(150,285,'TOTAL: $'.$total);
// $pdf->text(170,285,'TOTAL: ');
$pdf->Output();
?>