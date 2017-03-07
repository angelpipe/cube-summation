<?php

namespace Tests\Feature;

use Tests\TestCase;

class CubeTest extends TestCase
{
    /**
     * homepage basic test.
     *
     * @return void
     */
    public function testHomeBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * parse page basic test.
     *
     * @return void
     */
    public function testParseBasicTest()
    {
        $response = $this->post('/parse', array('abc'));

        $response->assertStatus(200);
    }

    /**
     * parse page basic test.
     *
     * @return void
     */
    public function testParserObject()
    {
        $input = '4 5' . PHP_EOL .
            'UPDATE 2 2 2 4' . PHP_EOL .
            'QUERY 1 1 1 3 3 3' . PHP_EOL .
            'UPDATE 1 1 1 23' . PHP_EOL .
            'QUERY 2 2 2 4 4 4' . PHP_EOL .
            'QUERY 1 1 1 3 3 3' . PHP_EOL .
            '2 4' . PHP_EOL .
            'UPDATE 2 2 2 1' . PHP_EOL .
            'QUERY 1 1 1 1 1 1' . PHP_EOL .
            'QUERY 1 1 1 2 2 2' . PHP_EOL .
            'QUERY 2 2 2 2 2 2';
        $expectedOutput = array('output' => array(4, 4, 27, 0, 1, 1));
        $parser = $this->app->make('App\Cube\Parser');
        $result = $parser->parse($input);

        $this->assertArraySubset($expectedOutput, $result);
    }
}
