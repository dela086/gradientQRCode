<?php

namespace Gradient\Qrcode\Norm;

interface ExtInterface
{
    /**
     * 创建一个张图实例
     */
    public function create($imageString);

    /**
     * 构建图片
     */
    public function build();

    /**
     * 输出图片
     */
    public function output($output);
}
