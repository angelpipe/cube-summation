<?php

namespace App\Cube;

class Cube
{
    /**
     * Three dimensions matrix that represents the cube.
     *
     * @var array
     */
    protected $matrix;

    /**
     * Current size of the cube.
     *
     * @var array
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
        $this->matrix[$x - 1][$y - 1][$z - 1] = $value;
    }

    /**
     * Retrieve the sum of the values stored in a cube's range.
     *
     * @param int    $x1    X1 coordinate
     * @param int    $y1    Y1 coordinate
     * @param int    $z1    Z1 coordinate
     * @param int    $x2    X2 coordinate
     * @param int    $y2    Y2 coordinate
     * @param int    $z2    Z2 coordinate
     *
     * @return int
     */
    public function summate ($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $sum = 0;
        for ($x = $x1 -1; $x < $x2; $x++) {
           for ($y = $y1 -1; $y < $y2; $y++) {
               for ($z = $z1 -1; $z < $z2; $z++) {
                   $sum += $this->matrix[$x][$y][$z];
               }
           }
        }

        return $sum;
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
