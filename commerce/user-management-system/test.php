<?php

 $conn = mysqli_connect("localhost", "root", "", "ordredemission");  
 mysqli_query($conn, "set NAMES utf8");
 if(isset($_GET["num_om"]))
 {
	 $num_om = $_GET["num_om"]; 
 } else 
 if( isset($_GET['search']) ){   
	$num_om = mysqli_real_escape_string($conn, htmlspecialchars($_GET['search']));
 }
	$sql = "SELECT * FROM ordre_missions WHERE num_om='$num_om' AND id_tr='0'";  
    $result = mysqli_query($conn, $sql); 
	if($row = mysqli_fetch_array($result))
    {		  
		$sql1 = "SELECT * FROM missionnaire WHERE id_m =".$row["id_m"];  
		$result1 = mysqli_query($conn, $sql1);  
		$row1 = mysqli_fetch_array($result1);
		$sql100 = "SELECT * FROM moyen_transport WHERE id_mt='$row[moyen_transport]'";
		$result100 = mysqli_query($conn, $sql100); 
		$row100 = mysqli_fetch_array($result100);
		$sql0 = "SELECT * FROM objet_mission WHERE id_obj='$row[objet_om]'";
		$result0 = mysqli_query($conn, $sql0); 
		$row0 = mysqli_fetch_array($result0);
		$sql10 = "SELECT * FROM destinations WHERE id_dst='$row[destination]'";
		$result10 = mysqli_query($conn, $sql10); 
		$row10 = mysqli_fetch_array($result10);
	} else{
		echo 'Se numéro n existe pas';
	} 
		$datetime = date("Y-m-d");
		require_once('tcpdf/tcpdf.php');  
		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle("أمر بمهمة");
		$pdf->SetHeaderData('','',PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		//$pdf->SetAutoPageBreak(TRUE, 10);
		//$pdf->SetFont('helvetica', '', 11);
		$pdf->AddPage();
		$content = '';
		$content .= '
		<table border="1" cellspacong="0" cellpadding="3">
			<tr>
				<td width="15%">
					<h3 class="num" align="center"> رقم : '.$row["num_om"].'/'.$row["exercise"].' </h3>
					
				</td> 
				<td width="40%">
					<h1 align="center" width="270" height="90">أمر بمهمة</h1>
				</td>
				<td width="35%">
						<h5 align="center">الشــــركة الجــزائــريـــة لصنـــاعــــة المحركات بالعلامات الألمانية</h5>
						<h6 align="center">المنطقة الصناعية واد حميميم الخروب قسنطينة</h6>
				</td>
				<td width="10%">
					<img align="right" src="logo.png" style="height: 100px; width: 110px;" />
				</td>
			</tr>
		';
		//$content .= fetch_data();
		$content .= '</table>';
		$pdf->SetFont('freeserif', '', 12);
		$content .= '
			<br/>
			<table border="1" cellspacong="0" cellpadding="3">
				
					<h3 align="right">  الإسم و اللقب : '.$row1["nom_m"].' '.$row1["prenom_m"].' </h3>
				<br/><br/>
					<h3 align="right">  الوظيفة : '.$row1["fonction"].'</h3>
				<div></div>
					<h3 align="right">  المصلحة أو الدائرة : '.$row1["direction"].'</h3>
				<div></div>
					<h3 align="right">  مكان الإتجاه : '.$row10[1].'</h3>
				<div></div>
					<h3 align="right">  غاية المهمة : '.$row0[1].'</h3>
				<div></div>
					<h3 align="right">  تاريخ و ساعة المهمة : '.$row["date_mission"].'</h3>
					<h3 align="right">  تاريخ و ساعة الرجوع المتوقع : '.$row["date_retour"].'</h3>
					<h3 align="right">  وسيلة الإنتقال : '. $row[6] .'</h3>
					<h3 align="right"> رقم السيارة : '.$row["matricule"].'</h3>
				
					<h3 align="center"> واد حميميم في : '.date("d/m/Y").'</h3>
					<h3 class="leaf1"> التوقيع : &nbsp;&nbsp;&nbsp;&nbsp; </h3>
					<div></div><div></div>
		
			';
		$content .= '</table>';
		
		$content .= '
				<table border="1" cellspacong="0" cellpadding="3">
				<tr>
					<td>
						<h4 align="center">  إقرار ما بعد المهمة :</h4>
					</td>
					<td>
						<h4 align="center"> الهيئة المقصودة :</h4>
					</td>
					<td>
						<h4 align="center">  مركز الحراسة :</h4>
					</td>
				</tr>
			';
		$content .= '</table>';
		
		$content .= '
			<table border="1" cellspacong="0" cellpadding="3">
				<tr>
					<td>
						<p class="ge" align="right">  مهمة من :............&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ساعة :........</p> 
						<p class="ge" align="right">  إلى :............&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ساعة :........</p>
						<h4 align="right"> المسؤول المعني :</h4>
						<div></div>
						<h4 align="right"> المدير المعني :</h4>
						<div></div>
					</td>
					<td>
						<p align="right">  مدة الإقامة:</p>
						<p align="right">  من :............&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ساعة :........</p>
						<p align="right">  إلى :............&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ساعة :........</p>
						
						<h4 align="right"> الختم و الإمضاء :</h4>
						<div></div>
					</td>
					<td>
						<p align="right">  تاريخ و ساعة الخروج :</p>
						<div></div>
						<p align="right">  تاريخ و ساعة العودة :</p>
						<div></div>
						<h4 align="right"> تأشيرة مركز الحراسة :</h4>
						<div></div>
					</td>
				</tr>
			';
		$content .= '</table>';
		$pdf->writeHTML($content);
		$pdf->Output('file.pdf', 'I');
?>