<?php

namespace Laravie\Codex\Filter\Tests;

use PHPUnit\Framework\TestCase;

class CastTest extends TestCase
{
    /** @test */
    public function it_can_cast_from_input()
    {
        $this->assertSame('["A","B","C"]', (new Acme\Casts\Arr())->from(['A', 'B', 'C']));
    }

    /** @test */
    public function it_can_cast_from_response()
    {
        $this->assertSame(['A', 'B', 'C'], (new Acme\Casts\Arr())->to('["A","B","C"]'));
    }
}
