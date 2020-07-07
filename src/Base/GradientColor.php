<?php

namespace Gradient\QrCode\Base;

use Gradient\QrCode\Support\Helper;

class GradientColor extends Extend
{
    use Helper;
    protected $penColor;
    protected $hexColor;
    protected $alpha;

    public function __construct($hexColor = [], $alpha = 1)
    {
        $this->hexColor = $hexColor;
        $this->alpha = $alpha;
    }

    /**
     * 通过计算得出图片的颜色 index.
     * 然后根据 index 得到图片当前位置的颜色
     * 遍历每一个位置把黑色换成当前设置的颜色
     *
     * @return $this
     */
    public function build()
    {
        $this->setColor($this->hexColor, $this->alpha);

        $this->loopImagePoint(function ($x, $y, $color) {
            imagesetpixel($this->imageHandle, $x, $y, $color);
        }, $this->penColor);

        return $this;
    }

    /**
     * 设置图片的颜色，十六进制数组
     *
     * @param array $colorParameters
     * @param $alpha
     */
    protected function setColor(array $colorParameters, $alpha)
    {
        $this->penColor['start'] = trim($colorParameters['start']);
        $this->penColor['end'] = trim($colorParameters['end']);
    }
}
