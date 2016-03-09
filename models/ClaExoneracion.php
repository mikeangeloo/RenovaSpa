<?php
/**
 * ClaExoneracion.
 * Esta clase permite generar el PDF del formulario Exoneración de responsabilidades
 * Recibe a traves de POST todos los elementos a utilizar
 */

if(isset($_POST)){
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
	$edad=$_POST['edad'];
	$pais=$_POST['pais_id'];
	$correo=$_POST['correo_electronico'];
	$hotel=$_POST['hotel_id'];
	$habitacion=$_POST['habitacion'];
	$agencia=$_POST['agencia_id'];

    $obtTratamiento = new ClaTratamientos();
    $tratamiento = $obtTratamiento->obtenerPorId($_POST['tratamiento_id']);
    $tratamientos = $tratamiento['nombre'];


    $obtTerapeuta = new ClaTerapeutas();
    $tera = $obtTerapeuta->obtenerPorId($_POST['terapeuta_id']);
    $terapeuta = $tera['nombre'];




    $circunsta="";

    if(isset($_POST['circunstancia'])){
        foreach($_POST['circunstancia'] as $circu_data){
            $circunsta.="\n\r".$circu_data.",";
        }
    }

    if(isset($_POST['otracircu'])){
        $circunsta.="\n\r".$_POST['otracircu'].".";
    }
    $obtOpi = new ClaOpiniones();
    $opi = $obtOpi->obtenerPorId($_POST['opinion']);


    $opinion = $opi['nombre'];


}


// Include the main TCPDF library (search for installation path).
require_once('../../tcpdf/examples/tcpdf_include.php');
require_once('../../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Miguel Angel Ramirez Lopez');
$pdf->SetTitle('Exoneracion de Responsabilidad');
$pdf->SetSubject('TCPDF Tutorial');


// set default header data


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// IMPORTANT: disable font subsetting to allow users editing the document
$pdf->setFontSubsetting(false);

// set font
$pdf->SetFont('helvetica', '', 10, '', false);

// add a page
$pdf->AddPage();



// create some HTML content
$html = <<<EOD
<style>
#renova{
	float: left;
}
@media (min-width: 560px){


	.col-1{width: 8.333%;}

	.col-2{width: 16.666%;}

	.col-3{width:24.999%;}

	.col-4{width: 33.332%;}

	.col-5{width:41.665%;}

	.col-6{width: 49.998%;}

	.col-7{width:58.331%;}

	.col-8{width: 66.664%;}

	.col-9{width: 74.99%;}

	.col-10{width: 83.33%;}

	.col-11{width: 91.66%;}

	.col-12{width: 99.99%;}
	.col-14{width: 99.99%;}
	[class *="col-"]{
		float: left;
		padding: 20px;
		/*border: 1px solid blue;*/
        text-align: justify;
	}


}
[class *="col-"]{

	padding: 20px;
	/*border: 1px solid blue;*/
    text-align: justify;
}

*{
	box-sizing:border-box;
}
.row:after{
	content: "";
	clear: both;
	display: block;
}

h1{
	text-align: center;
}
hr{
	color: black;
}
button{
	border-radius: 20%;
}

textarea{
	width: 100%;
	height: 102px;
}


input, select{
	border-radius: 15px;
}

::-webkit-input-placeholder {
  color: black;
}
form{
	width: 100%;
	max-width: 100%;
}
b, #btn1{
	float: right;
	display: inline-block;
}


nav{
	text-align: center;
}

.cartaencabezado{
	margin: auto;
	text-align: center;
	font-size: 24px;
	font-family: AvantGardeExtLitITCTT;
	color: #a8a9ac;
}
p{
	margin: auto;
	text-align: center;
	font-size: 15px;
	font-family: Arial;
	color: #000000;
	font-weight: bold;

}

#Relleno{
	margin: 25px;
	border-color: black;
}

.textNom{
	width: 30%;
	display: inline-block;
	height: 4%;
}
.id{
	width: 60%;
	display: inline-block;
	height: 4%;

}

.textEda{

	width: 20%;
	display: inline-block;
	height: 4%;


}
.textPai{
	width: 40%;
	height: 4%;
	display: inline-block;

}

.textEma{
	width: 48%;

	height: 4%;
	display: inline-block;
}

.textHot{
	width: 50%;
	display: inline-block;
	height: 4%;
}

.textHab{

	width: 35%;
	display: inline-block;
	height: 4%;
}

.textAge{
	width: 91%;
	display: inline-block;
	height: 4%;
}

.textTra{
	width: 35%;
	height: 4%;
	display: inline-block;
}

.textTer{
	width: 47%;

	height: 4%;
	display: inline-block;;
}

td{
	text-align: center;
}

#imagenes{

	display: inline-block;

}
.logo{
    width: 200px;
    height: auto;
    display: inline-block;
    position: absolute;
}


#check input{
	margin-right: 99px;
	margin-left: 102px;
}
#opinion{
	display: inline-block;
}

.footer{

   bottom:0;
   font-size: 8px;
   text-align: center;
}
li{text-align: justify;}
</style>
<meta charset="utf-8">
<img class ="logo" src="../webroot/img/logo.jpg">
<div  id="formulario">

<h1>Exoneracion de Responsabilidad</h1>
</div>
<br>
<div class="col-12 cartaencabezado">
    Bienvenido | welcome | willkommen | benvenuto | valkomen | bienvenue
</div>

<p>Por favor, dedique unos minutos a leer cuidadosamente
    la informacion siguiente y suscribirla con una
    firma al finalizar. Muchas gracias.
</p>
<br>
<br>
<div class="col-12">
<div id="Relleno">
<form method="post" action="" enctype="multipart/form-data">

<div class="col-14">
<label for="nombre">Nombre:</label>
<input type="text" placeholder="Nombre:" class="textNom" id="nombre" name="nombre" value="{$nombre}" size="25%" maxlength="25%"/>
<label for="apellidos">Apellidos: </label>
 <input type="text" size="25%" maxlength="25%" class="textNom" id="apellidos" name="apellidos" value="{$apellidos}">
<label for="edad">Edad: </label> <input type="text" placeholder="Edad:" class="textEda" id="edad" name="edad" size="20%" maxlength="20%" value="{$edad}">
</div>

 <br />
 <br />

<div class="col-14">
<label for="pais_id">Pais:</label><input type="text"  size="40%" maxlength="40%" class="textPai" id="pais_id" name="pais_id" value="{$pais}">
<label for="correo_electronico">Correo:</label> <input type="text" class="textEma" size="41%" maxlength="41%" id="correo_electronico" name="correo_electronico" value="{$correo}">
</div>

<br>
<br>

<div class="col-14">
<label for="hotel_id">Hotel:</label> <input type="text"  class="textHot" id="hotel_id" size="39%" maxlength="39%" name="hotel_id" value="{$hotel}">
<label for="habitacion">Habitacion:</label> <input type="text"  class="textHab" id="habitacion" size="38%" maxlength="38%" name="habitacion" value="{$habitacion}">
</div>

<br>
<br>

<div class="col-14">
<label for="agencia_id">Agencia:</label> <input type="text"  class="textAge" name="agencia_id" size="85%" maxlength="85%" id="agencia_id" value="{$agencia}">
</div>

<br>
<br>

<div class="col-14">
<label for="tratamiento">Tratamiento:</label> <input type="text"  class="textAge" name="tratamiento" size="34%" maxlength="34%" id="tratamiento" value="{$tratamientos}">
<label for="terapeuta">Terapeuta:</label> <input type="text"  class="textAge" name="terapeuta" size="38%" maxlength="38%" id="terapeuta" value="{$terapeuta}">
</div>


</form>

<div class="col-14">
<ol>
<li value="1">El masaje o tratamiento que usted va a recibir tiene el proposito basico de la relajacion y el alivio de
    la tension muscular superficial.</li>
<br>
<li>Si usted esta insatisfecho con el servicio, o experimenta cualquier tipo de molestia o dolor durante la
    sesion, informe por favor al terapeuta cuanto antes.</li>
<br>
<li>Si no se menciona nada durante la sesion, asumiremos que no ha habido ningun problema.</li>
<br>
<li>Haganos saber antes del inicio de la sesion si se encuentra bajo algunas de las siguientes circunstancias:</li>
<br>
<br>
<br>
<textarea type="text"  class="textAge" name="comentario" size="80%" maxlength="80%" id="comentario" cols="80" rows="3">$circunsta</textarea>

<br>
<br>




<br>
<br>

<li>Cualquier insinuacion, hecho o propuesta de caracter sexual ocasionara el final inmediato de la
    sesion y el/la huesped sera obligado al pago completo del servicio.</li>
<br>
<li>Por la seguridad de sus valores, le sugerimos dejarlos en la caja fuerte de su habitacion.
    Renova spa no asumira ninguna responsabilidad por robo o extravio de valores.</li>
</ol>
<p>Le agradecemos su comprension y esperamos que disfrute de nuestros servicios.</p>
</div>
<br>
<br>
<br>
<br>
<br>
<table style="margin: 0 auto;"  width="80%">
<tr>
<td><hr style='width: 50%'>Firma del Terapeuta</td>
<td><hr style='width: 50%'>Firma del Cliente</td>
</tr>
</table>
<br>
<p>Por favor ayudenos a mejorar nuestros servicios dandonos su opinion sobre le servicio recibido.</p>
<br>
<br>
<br>
<div id="imagenes"  class="col-12">
<label for="opinion">Opiniones:</label> <input type="text"  class="textAge" name="opinion" size="30%" maxlength="30%" id="opinion" value="{$opinion}">
</div>
</div>
<p class="footer">Dada la inexistencia previa de condicion medica especial, Renova Spa y el Hotel no se hacen responsables
    de ningun efecto secundario resultante.
</p>
EOD;

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('exoneracion001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
