<?php
namespace Gradient\QrCode;

use Closure;
use Gradient\QrCode\Norm\ExtInterface;
use Endroid\QrCode\QrCode;

class QrCodeExt
{
    protected $qrCodeHandle;
    protected $output;

    public function __construct($text = '')
    {
        $this->qrCodeHandle = new QrCode($text);
    }

    /**
     * 直接输出二维码
     *
     * @param ExtInterface $color
     */
    public function output(ExtInterface $color)
    {
        $imageString = $this->qrCodeHandle->writeString();

        $color->create($imageString)
            ->build()
            ->output($this->output);
    }

    /**
     * 设置输出类型，实际
     * DavidNineRoc\Qrcode\Foundation\Plus 中调用
     *
     * @param Closure $closure
     * @return $this
     */
    public function setOutput(Closure $closure)
    {
        $this->output = $closure;
        return $this;
    }

    /**
     * 不直接输出图片，截取输出返回
     *
     * @param ExtInterface $color
     * @return $this
     */
    public function getOutput(ExtInterface $color)
    {
        ob_start();
        $this->output($color);

        return ob_get_clean();
    }

    /**
     * 当调用不存在的方法时，去调用
     * \Endroid\QrCode\\Qrcode 的方法
     *
     * @param $method
     * @param $parameters
     * @return $this
     */
    public function __call($method, $parameters)
    {
        $this->qrCodeHandle->$method(...$parameters);

        return $this;
    }
}
