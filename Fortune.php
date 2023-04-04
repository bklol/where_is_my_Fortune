<?
    header("Content-type:image/png");
    
    $Fortune_file = ""; //your json Fortune_file path
    $Fortune_imgfile = "";//your background img Fortune_file path
    $height = 700;
    $width = 650;
    $fontSize = 18;
    $font = "YS.ttf";
    $img = resize(imagecreatefrompng($Fortune_imgfile), $width, $height);
    $Fortune = GetFortune();
    $Fortunedata = json_decode(file_get_contents($Fortune_file), true);
    $msg = explode("\n", $Fortunedata[$Fortune][rand(0, count($Fortunedata[$Fortune]) - 1)]);
    
    
    $gold = imagecolorallocate($img, 205, 127, 50);
    for($i = 0; $i < count($msg); $i++)
    {
        $fontBox = imagettfbbox($fontSize, 0, $font, $msg[$i]);
        $x = ceil(($width - $fontBox[2]) / 2);
        $y = 200 + $i * 29;
        imagettftext($img, $fontSize, 0, $x, $y, $gold, $font, $msg[$i]);
    }
    
    display_img($img);
    
    function display_img($img)
    {
        imagepng($img);
        imagedestroy($img);
    }
    
    
    function resize($img, $newx = 50, $newy = 50)
    {
        $x = imagesx($img);
        $y = imagesy($img);
        $im2 = imagecreatetruecolor($newx,$newy);
        imagecopyresized($im2, $img, 0, 0, 0, 0, $newx,$newy, $x, $y);
        return $im2;
    }

    function GetFortune()
    {
        $rand = rand(0,2);
        switch($rand)
        {
            case 0: return '末吉';break;
            case 1: return '吉';break;
        }
        $rand = rand(0,3);
        switch($rand)
        {
            case 0: return '凶';break;
            case 1: return '中吉';break;
            case 2: return '大吉';break;
        }
        return '大凶'; //那你可真是倒霉
    }

    
    
    
    
    