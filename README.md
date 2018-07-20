# compress-image

## Php image upload with Compress

---------------------------------

``` 
$target 	= basename($_FILES['image']['name']);
$file 		= $_FILES['image']['tmp_name'];
$target 	= 50;
compressImage($file , $target , $quality);
``` 
