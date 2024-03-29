<?php

namespace Laravie\Codex\Filter\Tests;

use Laravie\Codex\Filter\Sanitizer;
use PHPUnit\Framework\TestCase;

class SanitizerTest extends TestCase
{
    /** @test */
    public function it_can_sanitize_from_inputs()
    {
        $stub = new Sanitizer();
        $stub->add('meta', new Acme\Casts\Arr());
        $stub->add('created_at', new Acme\Casts\Carbon());

        $given = [
            'meta' => ['circles' => [1, 2, 3], 'score' => 100],
            'created_at' => new \DateTime('2017-08-31'),
        ];

        $expected = [
            'meta' => '{"circles":[1,2,3],"score":100}',
            'created_at' => '2017-08-31',
        ];

        $this->assertEquals($expected, $stub->from($given));
    }

    /** @test */
    public function it_can_sanitize_to_response()
    {
        $stub = new Sanitizer();
        $stub->add('meta', new Acme\Casts\Arr());
        $stub->add('created_at', new Acme\Casts\Carbon());

        $given = [
            'meta' => '{"circles":[1,2,3],"score":100}',
            'created_at' => '2017-08-31',
        ];

        $expected = [
            'meta' => ['circles' => [1, 2, 3], 'score' => 100],
            'created_at' => new \DateTime('2017-08-31'),
        ];

        $this->assertEquals($expected, $stub->to($given));
    }

    /** @test */
    public function it_can_sanitize_from_inputs_on_nested_array()
    {
        $stub = new Sanitizer();
        $stub->add(['meta', 'circles'], new Acme\Casts\Arr());
        $stub->add('created_at', new Acme\Casts\Carbon());

        $given = [
            'meta' => ['circles' => [1, 2, 3]],
            'created_at' => new \DateTime('2017-08-31'),
        ];

        $expected = [
            'meta' => ['circles' => '[1,2,3]'],
            'created_at' => '2017-08-31',
        ];

        $this->assertEquals($expected, $stub->from($given));
    }

    /** @test */
    public function it_can_sanitize_to_response_on_nested_array()
    {
        $stub = new Sanitizer();
        $stub->add(['meta', 'circles'], new Acme\Casts\Arr());
        $stub->add('created_at', new Acme\Casts\Carbon());

        $given = [
            'meta' => ['circles' => '[1,2,3]'],
            'created_at' => '2017-08-31',
        ];

        $expected = [
            'meta' => ['circles' => [1, 2, 3]],
            'created_at' => new \DateTime('2017-08-31'),
        ];

        $this->assertEquals($expected, $stub->to($given));
    }
}
