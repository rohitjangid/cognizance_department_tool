<?php
$type=$_POST['type'];
if($type=='dept')
{
	$dept=$_POST['dept'];
	$event=$_POST['event'];
}
elseif($type=='central')
{
	$eve=$_POST['event'];
	$eve=explode("/",$eve);
	$dept=$eve[0];
	$event=$eve[1];
}

switch($dept)
{
	case "ahec":
		$deptc="AHEC";
		break;
	case "archi":
		$deptc="Architecture Department";
		break;
	case "bio":
		$deptc="Biotech Department";
		break;
	case "trans":
		$deptc="C-Trans";
		break;
	case "ch":
		$deptc="Chemical Department";
		break;
	case "chem":
		$deptc="Chemistry Department";
		break;
	case "civ":
		$deptc="Civil Department";
		break;
	case "coedmm":
		$deptc="CoEDMM";
		break;
	case "cse":
		$deptc="Computer Science Department";
		break;
	case "dom":
		$deptc="Department of Management Studies";
		break;
	case "es":
		$deptc="Earth Sciences Department";
		break;
	case "eq":
		$deptc="Earthquake Department";
		break;
	case "ece":
		$deptc="Electronics and Communication Department";
		break;
	case "ee":
		$deptc="Electrical Department";
		break;
	case "hyd":
		$deptc="Hydrology Department";
		break;
	case "math":
		$deptc="Mathematics Department";
		break;
	case "meta":
		$deptc="Metallurgy Department";
		break;
	case "mied":
		$deptc="Mechanical and Industrial Department";
		break;
	case "nano":
		$deptc="Nanotech Department";
		break;
	case "phy":
		$deptc="Physics Department";
		break;
	case "wrdm":
		$deptc="WRDM";
		break;
	case "cop":
		$deptc="Construct O Polis";
		break;
	case "aur":
		$deptc="Aurora";
		break;
	case "tgw":
		$deptc="The Green Walk";
		break;
	case "sci":
		$deptc="Sciennovate";
		break;
	case "fin":
		$deptc="Finnese";
		break;
	case "tbi":
		$deptc="The Bron Identita";
		break;
	case "amd":
		$deptc="Armageddon";
		break;
	case "pd":
		$deptc="Powerdrift";
		break;
	case "rs":
		$deptc="Robosapiens";
		break;
	case "cb":
		$deptc="Cyborg Breakin";
		break;
	case "an":
		$deptc="Aeronave";
		break;
	case "cec":
		$deptc="Chem-E-Car";
		break;
	case "cor":
		$deptc="Corpostrat";
		break;
	case "rbc":
		$deptc="Rubiks Cube";
		break;
	case "crx":
		$deptc="Chain Reaction";
		break;
	case "ign":
		$deptc="Ignite";
		break;
	case "ele":
		$deptc="Elevator Pitch";
		break;
	case "tss":
		$deptc="Tech Startup Showcase";
		break;
	case "rc":
		$deptc="Rural Congress";
		break;
	case "sc":
		$deptc="Silence Calling";
		break;
	case "mun":
		$deptc="IITR MUN";
		break;
	case "vp":
		$deptc="Vox Populi";
		break;
	case "quz":
		$deptc="Quizzotica";
		break;
}

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
 
class MYPDF extends TCPDF {
	public function Header() {
		$this->setJPEGQuality(90);
		$this->Image('./images/logo.png', 10, 10, 68.5, 0, 'PNG', 'http://www.cognizance.org.in');
		

		date_default_timezone_set('Asia/Calcutta');
		$this->CreateTextBox('Generated On: '.date('d/m/Y H:i:s'), 100, 20, 80, 10, 10, 'I','R');
		$this->SetLineWidth('0.5');
		$this->Line(5, 34, 205, 34);
		$this->SetLineWidth('0.2');
		$this->Line(5, 35, 205, 35);
		
		// Table Head
		$this->Line(15,45,200,45);
		$this->CreateTextBox('Sr. No.',0,45,80,10,10,'B','L');
		$this->CreateTextBox('Team ID',25,45,80,10,10,'B','L');
		$this->CreateTextBox('Cogni ID',55,45,80,10,10,'B','L');
		$this->CreateTextBox('Member'.chr(39).'s Name',92,45,80,10,10,'B','L');
		$this->CreateTextBox('Marks',140,45,80,10,10,'B','L');
		$this->CreateTextBox('Rank',165,45,80,10,10,'B','L');
		$this->Line(15,55,200,55);
		$this->Line(15,45,15,55); //1st vertical line
		$this->Line(37,45,37,55); //2nd vertical line
		$this->Line(70,45,70,55); //3rd vertical line
		$this->Line(97,45,97,55); //4th vertical line
		$this->Line(155,45,155,55); //5th vertical line
		$this->Line(180,45,180,55); //6th vertical line
		$this->Line(200,45,200,55); //7th vertical line

 
	}
	public function Footer() {
		$this->SetY(-15);
		$this->SetFont(PDF_FONT_NAME_MAIN, 'I', 8);
		//$this->Cell(0, 10, 'Cognizance 2014', 0, false, 'C');
		$this->SetLineWidth('0.5');
		$this->Line(5, 262, 205, 262);
		$this->SetLineWidth('0.2');
		$this->Line(5, 263, 205, 263);
		$this->CreateTextBox('Coordinator', 0, 280, 80, 10, 10);
		$this->CreateTextBox('Judge', 155, 280, 80, 10, 10);
	}
	public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
		$this->SetXY($x+20, $y); // 20 = margin left
		$this->SetFont(PDF_FONT_NAME_MAIN, $fontstyle, $fontsize);
		$this->Cell($width, $height, $textval, 0, false, $align);
	}
}


include 'dbconnect.php';
$result=mysqli_query($con,"SELECT * FROM event_scored WHERE dept='$dept' AND event='$event'");
$length=0;
while($row=mysqli_fetch_array($result))
{
	$teamid[$length]=$row['team_id'];
	$memname[$length]=$row['member_name'];
	$memcid[$length]=$row['member_cid'];
	$memname[$length]=explode(";",$memname[$length]);
	$memcid[$length]=explode(";",$memcid[$length]);
	$participant[$length]=count($memname);
	$marks[$length]=$row['marks'];
	$rank[$length]=$row['rank'];
	$length++;
}

// create a PDF object
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// set document (meta) information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Rohit Jangid');
$pdf->SetTitle('Cognizance 2014 Event Report Sheet');
 
// add a page
$pdf->AddPage();
$pdf->CreateTextBox($deptc, 100, 10, 80, 10, 10, 'I','R');
$pdf->CreateTextBox($event, 100, 15, 80, 10, 10, 'I','R');
 
//listing marks
$i=0;
$currx=3;
$curry=55;
while($i<$length)
{
	if($i%5==1 && $i!=1)
	{
		$pdf->AddPage();
		$pdf->CreateTextBox($deptc, 100, 10, 80, 10, 10, 'I','R');
		$pdf->CreateTextBox($event, 100, 15, 80, 10, 10, 'I','R');
		$currx=3;
		$curry=55;
	}
	$pdf->CreateTextBox($i+1,$currx,$curry,80,10,10);
	$pdf->CreateTextBox($teamid[$i],$currx+15,$curry,80,10,10);
	$pdf->CreateTextBox($marks[$i],$currx+140,$curry,80,10,10);
	$pdf->CreateTextBox($rank[$i],$currx+165,$curry,80,10,10);
	
	for($j=0;$j<=$participant[$i];$j++)
	{
		$pdf->CreateTextBox($memcid[$i][$j],$currx+48,$curry,80,10,10); //member cogniid
		$pdf->CreateTextBox($memname[$i][$j],$currx+87,$curry,80,10,10); //member name
		$pdf->Line(15,$curry,15,$curry+7); //1st vertical line
		$pdf->Line(37,$curry,37,$curry+7); //2nd vertical line
		$pdf->Line(70,$curry,70,$curry+7); //3rd vertical line
		$pdf->Line(97,$curry,97,$curry+7); //4th vertical line
		$pdf->Line(155,$curry,155,$curry+7); //5th vertical line
		$pdf->Line(180,$curry,180,$curry+7); //6th vertical line
		$pdf->Line(200,$curry,200,$curry+7); //7th vertical line
		$curry+=7;
	}
	$pdf->Line(15,$curry,15,$curry+3); //1st vertical line
	$pdf->Line(37,$curry,37,$curry+3); //2nd vertical line
	$pdf->Line(70,$curry,70,$curry+3); //3rd vertical line
	$pdf->Line(97,$curry,97,$curry+3); //4th vertical line
	$pdf->Line(155,$curry,155,$curry+3); //5th vertical line
	$pdf->Line(180,$curry,180,$curry+3); //6th vertical line
	$pdf->Line(200,$curry,200,$curry+3); //7th vertical line
	$curry+=3;
	$pdf->Line(15,$curry,200,$curry); //horizontal line
	$i++;
}
 
//Close and output PDF document
$filename=$dept."_".$event.'_Scorecard.pdf';
$pdf->Output($filename, 'I');


?>