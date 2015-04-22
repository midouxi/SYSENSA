<?php
session_start(); $login=$_SESSION['id'];

header("Content-Type: image/png");

$note=explode(";",$_GET['note']);

 $image = imagecreate(1000,500);

 $fond = imagecolorallocate($image,255,255,255);
$gris = imagecolorallocate($image,200,200,200);
$noir = imagecolorallocate($image,0,0,0);
$rouge = imagecolorallocate($image,255,0,0);
 imagefill($image,0,0,$fond);

imageline($image,10,400,999,400,$noir);
imageline($image,10,400,10,0,$noir);

imagestring($image,5,200,0,"$note[0]",$noir);
$y=0;
//affichage des ordonnées 
for($j=20;$j>=0;$j--){
	imageline($image,10,$y,999,$y,$gris);
	imagestring($image,0,0,$y,"$j",$noir);
	$y+=20;
}
imageline($image,10,200,999,200,$noir);
//-----------------------------------
$max=20;
$max*=count($note);
$max-=20;
$j=1;
for($i=20;$i<$max;$i+=10){
	$note_eleve=$note[$j];
	imagestring($image,0,$i,410,"$j",$noir);
	if($j%2==0) $color=$noir; else $color=imagecolorallocate($image,0,0,255);
	$note_val=20;$note_val*=$note_eleve;
	$min=400;$min-=$note_val;
	imagefilledrectangle($image,$i,$min,$i+=10,399,$color);
	$j++;
}
$moyenne=$note[$j];
$note_val=20;$note_val*=$moyenne;
$min=399;$min-=$note_val;
imageline($image,10,$min,999,$min,$rouge);
imagepng($image);

?>
