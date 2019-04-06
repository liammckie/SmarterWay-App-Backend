<?php
/* include autoloader */
require_once 'dompdf/autoload.inc.php';


/* reference the Dompdf namespace */
use Dompdf\Dompdf;


/* instantiate and use the dompdf class */
$dompdf = new Dompdf();


$html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<h1>Welcome to ItSolutionStuff.com</h1>
		<table class="table table-bordered">
			<tr>
				<th colspan="2">Information Form</th>
			</tr>
			<tr>
				<th>Name</th>
				<td>'.$_POST['name'].'</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>'.$_POST['email'].'</td>
			</tr>
			<tr>
				<th>Website URL</th>
				<td>'.$_POST['url'].'</td>
			</tr>
			<tr>
				<th>Say Something</th>
				<td>'.nl2br($_POST['say']).'</td>
			</tr>
		</table>';


$dompdf->loadHtml($html);


/* Render the HTML as PDF */
$dompdf->render();


/* Output the generated PDF to Browser */
$dompdf->stream();
?>