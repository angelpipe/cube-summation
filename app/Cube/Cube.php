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

    /**
     * Current size of the cube.
     *
     * @var multidimensional array
     */
    protected $size;

    public function __construct ()
    {
        $this->matrix = array();
        $this->size = 0;
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
        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                for ($z = 0; $z < $size; $z++) {
                    $this->matrix[$x][$y][$z] = 0;
                }
            }
        }
        $this->size = $size;
    }

    /**
     * Set a value in a cube's position.
     *
     * @param int    $x     X coordinate
     * @param int    $y     Y coordinate
     * @param int    $z     Z coordinate
     * @param int    $value Value to store
     *
     * @return void
     */
    public function update ($x, $y, $z, $value)
    {
        $this->matrix[$x][$y][$z] = $value;
    }

    /**
     * Retrieve cube's size.
     *
     * @return int
     */
    public function getSize ()
    {
        return $this->size;
    }
}
