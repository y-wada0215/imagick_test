<?php

	// 空の画像を作成する
	$img = imagecreatetruecolor(381, 400);
	
	// 背景を透明にする
	imagecolortransparent($img, imagecolorallocate($img, 1, 1, 1));

	// 画像ファイル名群
	$image1 = $_FILES['upimg1']['tmp_name'];
	$image2 = $_FILES['upimg2']['tmp_name'];
	$imgFns = array($image1 , $image2);

	// シンプルな画像合成
	foreach($imgFns as $fn){

 		$img2 = imagecreatefrompng($fn); // 合成する画像を取り込む

 		// 合成する画像のサイズを取得
		$sx = imagesx($img2);
		$sy = imagesy($img2);
		
		imageLayerEffect($img, IMG_EFFECT_ALPHABLEND);// 合成する際、透過を考慮する
		imagecopy($img, $img2, 0, 0, 0, 0, $sx, $sy); // 合成する
		
		imagedestroy($img2); // 破棄
	}
	
	// 別名で保存
	imagepng( $img, "composed/combine.png");
	imagedestroy($img);

	include("result.tpl"); 