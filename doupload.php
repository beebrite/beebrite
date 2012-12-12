<?php
if(isset($_POST))
{
//	$DestinationDirectory	= "C:\inetpub\wwwroot\beebrite_dev\usrpics\\";
	
	$DestinationDirectory	= "/srv/www/htdocs/usrpics//";

	if(!isset($_FILES['fileToUpload']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name']))
	{
			die('Something went wrong with Upload, May be File too Big?');
	}

	$RandomNumber 	= date("YmdHis").rand(0, 9999999999);
	
	$ImageName 		= strtolower($_FILES['fileToUpload']['name']);
	$ImageSize 		= $_FILES['fileToUpload']['size']; 
	$TempSrc	 	= $_FILES['fileToUpload']['tmp_name'];
	$ImageType	 	= $_FILES['fileToUpload']['type'];
	$process 		= true;
	
	switch(strtolower($ImageType))
	{
		case 'image/png':
			$CreatedImage = imagecreatefrompng($_FILES['fileToUpload']['tmp_name']);
			break;		
		case 'image/jpeg':
			$CreatedImage = imagecreatefromjpeg($_FILES['fileToUpload']['tmp_name']);
			break;
		default:
			die('Unsupported File!');
	}

	list($CurWidth,$CurHeight)=getimagesize($TempSrc);
	
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
  	$ImageExt = str_replace('.','',$ImageExt);
	
/*	$Dest180 = $DestinationDirectory.'180\\'.$RandomNumber.'.'.$ImageExt;
	$Dest100 = $DestinationDirectory.'100\\'.$RandomNumber.'.'.$ImageExt;
	$Dest050 = $DestinationDirectory.'50\\'.$RandomNumber.'.'.$ImageExt;
*/
	$Dest180 = $DestinationDirectory.'180//'.$RandomNumber.'.'.$ImageExt;
	$Dest100 = $DestinationDirectory.'100//'.$RandomNumber.'.'.$ImageExt;
	$Dest050 = $DestinationDirectory.'50//'.$RandomNumber.'.'.$ImageExt;

	
	if(resizeImage($CurWidth,$CurHeight,180,$Dest180,$CreatedImage))
	{
		resizeImage($CurWidth,$CurHeight,100,$Dest100,$CreatedImage);
		resizeImage($CurWidth,$CurHeight,50,$Dest050,$CreatedImage);
		echo '<div id="divPhotoCont" style="background-image:url(usrpics/180/'.$RandomNumber.'.'.$ImageExt.');background-position:center;background-repeat:no-repeat;width:180px;height:180px"></div>';
		
	}else{
		die('Resize Error');
	}

}

function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage)
{
	if ($CurWidth < $CurHeight)
	{
		$src_x = 0;
		$src_y = ($CurHeight - $CurWidth) / 2;
		$src_w  = $CurWidth;
		$src_h = $CurWidth;
		$NewCanves = imagecreatetruecolor($MaxSize, $MaxSize);
	}
	else
	{
		$src_x = ($CurWidth - $CurHeight) / 2;
		$src_y = 0;
		$src_w  = $CurHeight;
		$src_h = $CurHeight;
		$NewCanves = imagecreatetruecolor($MaxSize, $MaxSize);
	};


	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $src_x, $src_y, $MaxSize, $MaxSize, $src_w, $src_h))
	{
		if(imagejpeg($NewCanves,$DestFolder,100))
		{
			imagedestroy($NewCanves);
			return true;
		}
	}
}
?>