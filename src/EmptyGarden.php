<?php

/**
 * 
 * Description of EmptyGarden (Purpose of this class)
 */
class EmptyGarden {
    private float $width;
    private float $height;

    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function items() {
        $numberOfSpots = ceil($this->width * $this->height);
        return array_fill(0, $numberOfSpots, "Handful of dirt");
    }
}