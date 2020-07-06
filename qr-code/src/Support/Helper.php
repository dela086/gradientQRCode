<?php

namespace Gradient\QrCode\Support;


trait Helper
{
    /**
     * 十六进制转换成RGB颜色值
     *
     * @param $hex
     * @return array
     * @throws \Exception
     */
    public function hexChangeRgb($hex)
    {
        if (!is_string($hex) && '#' !== $hex[0]) {
            throw new \Exception('invalid hexadecimal color');
        }

        $hex = substr($hex, 1);

        $color = [];
        if (3 === strlen($hex)) {
            $color['r'] = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $color['g'] = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $color['b'] = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
        } elseif (6 === strlen($hex)) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        } else {
            throw new \Exception('invalid hexadecimal color count');
        }

        return $color;
    }

    // #ff00ff -> array(255,0,255) or #f0f -> array(255,0,255)
    public static function hex2rgb($color)
    {
        $color = str_replace('#', '', $color);
        $s = strlen($color) / 3;
        $rgb[] = hexdec(str_repeat(substr($color, 0, $s), 2 / $s));
        $rgb[] = hexdec(str_repeat(substr($color, $s, $s), 2 / $s));
        $rgb[] = hexdec(str_repeat(substr($color, 2 * $s, $s), 2 / $s));
        return $rgb;
    }
}
