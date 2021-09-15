<?php
	$author_name = "Greg K.";
	$full_time_now = date("d.m.Y, H:i:s");
	$weekday_now = date("N");
	$day_category = "lihtsalt päev";
	$hour_now = date("H");
	$hour_category = "";
	//echo $weekday_now;
	// võrdub == suurem/väiksem  < > <= >=, pole võrdne !=
	if($weekday_now <= 5) {
		$day_category = "koolipäev";
	} else {
		$day_category = "puhkepäev";
	}
	$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	
	if($day_category == "koolipäev") {
		if($hour_now < 8 or $hour_now >= 23){
			$hour_category = "uneaeg";
		} elseif($hour_now >= 8 and $hour_now < 18){
			$hour_category = "õppeaeg";
		} else {
			$hour_category = "vabaaeg";
		}
	} else {
		if($hour_now <= 12) {
			$hour_category = "uneaeg";
		} else {
			$hour_category = "vabaaeg";
		}
	}
	
	//echo $weekday_names_et[2]
	//juhusliku foro lisamine
	$photo_dir = "photos/";
	//loen kataloogi sisu
	$all_files = scandir($photo_dir);
	$all_real_files = array_slice($all_files, 2);
	
	//sõelume välja päris pildid
	$photo_files = [];
	$allowed_photo_types = ["image/jpeg", "image/png"];
	foreach ($all_real_files as $file_name) {
		$file_info = getimagesize($photo_dir .$file_name);
		if(isset($file_info["mime"])) {
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($photo_files, $file_name);
			} //if in_array lõpp
		}	//if isset lõpp
	} //foreach lõpp
	
	//echo $all_files;
	//var_dump ($all_real_files);
	//loen massiivi elemendid kokku
	$file_count = count($all_real_files);
	//loosin juhusliku arvu (min peab olema 0 ja max count - 1) mt_rand faster than just rand
	$photo_num = mt_rand(0, $file_count - 1);
	//<img src="kataloog/fail" alt="Tallinna Ülikool">
	$photo_html = '<img src="' .$photo_dir .$photo_files[$photo_num] .'" alt="Tallinna Ülikool">'; 
?>

<!DOCTYPE html>
<html lang="et">
<head> 
<style>
p.normal {
  font-weight: normal;
}

p.light {
  font-weight: lighter;
}

p.thick {
  font-weight: bold;
}

p.thicker {
  font-weight: 900;
}
</style>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, Webprogramming</title>
</head>
<body background="background1.jpg">
	<h1><?php echo $author_name; ?>, Webprogramming</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiselt võetavat sisu</p>
	<p>Õpptetöö toimus <a href="https://www.tlu.ee/dt">Tallina Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<img src="02.jpg" alt="random meme" width="600">
	<p class="thicker" style="font-family:Arial , font-size:50px" style="font-size:50px">o wow dancing skeletons</p>
	<IMG SRC="test.gif">
	<p>Lehe avamise hetk: <?php echo $weekday_names_et[$weekday_now - 1] .", " .$full_time_now .", " .$day_category .", " .$hour_category; ?>.</p>
	<?php echo $photo_html; ?>
</body>
</html>

