# gradientQRCode
生成彩色、渐变色 二维码，依赖于endroid/qr-code 
php >= 7.1
 // 生成二维码
```
	function qrCode() {
		// logo 图片，目前必须为本地图片路径，网络路径暂不支持
		$logo = public_path('public/static/images') . 'AppIcon.png';
		// 二维码颜色，start为渐变色开始颜色，end为渐变色结束颜色
		$color = Factory::color(['start'=> '#FFC500', 'end'=>'#D60006']);
		$qrcode = (new QrCodeExt())
			->setText('https://github.com/dela086/gradientQRCode')
			->setMargin(50)				// 二维码外部延伸距离
			-> setLogoPath($logo)		// logo 图片
			-> setLogoSize(70, 70)		// 设置logo 大小
			->setLabel('这个标题随便写什么都行', 20, null, LabelAlignment::CENTER) // 设置标题，包含标题内容、字体大小、字体和位置
			->setOutput(function ($handle) {
				imagepng($handle);
			})
			->getOutput($color);
		$im = imagecreatefromstring($qrcode);
		header("Content-type: image/png");
		imagepng($im);
		exit;
	}
  ```
