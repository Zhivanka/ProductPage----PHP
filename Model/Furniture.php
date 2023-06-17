<?php

declare(strict_types=1);

namespace Model;

use Model\Product;

class Furniture extends Product
{
    private float $height;
    private float $width;
    private float $length;

    public function __construct(string $name, string $sku, float $price, string $productType, float $height, float $width, float $length)
    {
        parent::__construct($name, $sku, $price, $productType);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function setLength(float $length): void
    {
        $this->length = $length;
    }

    public function getDimension(): string
    {
        return 'Dimension: '.$this->height. 'x'.$this->width.'x'.$this->length;
    }

    public function getTableFields(): array
    {
        return ['height','width','length'];
    }
}
