<?php

function compressImage($source , $destination , $quality)
{
	$info = getimagesize($source);
	switch ($info['mime']) {
		case 'image/jpeg': $image = imagecreatefromjpeg($source); imagejpeg($image , $destination , $quality); break;
		case 'image/gif': $image = imagecreatefromgif($source); imagejpeg($image , $destination , $quality); break;
		case 'image/png':
			$image = imagecreatefrompng($source);
			imagealphablending($image, false);
			imagesavealpha($image, true);
			$qf = ($quality==100) ? 99 : $quality;
			$qf = $qf / 10;
			$qf = 10 - $qf;
			imagepng($image , $destination , $qf);
 		break;
		default: return false; break;
	}
	return $destination;
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>File</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

	<div class="container"><br /><br /><br /><br />
		<form method="POST" action="index.php" enctype="multipart/form-data">
			<input type="file" name="image" /><br />
			<input type="hidden" name="username" value="emre arpacı" />
			<button name="formsubmit" type="submit" class="btn btn-primary">Upload</button>
		</form>
	</div>

</body>
</html>

<?php

if(isset($_POST['formsubmit']))
{
	$target 	= basename($_FILES['image']['name']);
	$file 		= $_FILES['image']['tmp_name'];
	if(compressImage($file , $target , 50))
	{
		echo '<script>alert("uploaded");</script>';
	}
	else
	{
		echo '<script>alert("error");</script>';
	}
}

?>