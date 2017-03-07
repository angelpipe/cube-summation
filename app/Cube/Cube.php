<?php

namespace App\Cube;

class Cube
{
    /**
     * Three dimensions matrix that represents the cube.
     *
     * @var multidimensional array
     */
    protected $matrix;

    public function __construct ()
    {
        $this->matrix = array();
    }

    /**
     * Init the matrix with a new size.
     *
     * @param int    $size  Size of the matrix
     *
     * @return void
     */
    public function init ($size)
    {
        $this->matrix = array();
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                for ($k = 0; $k < $size; $k++) {
                    $this->matrix[$i][$j][$k] = 0;
                }
            }
        }
    }
}
