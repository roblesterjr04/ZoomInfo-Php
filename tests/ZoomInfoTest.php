<?php

use Orchestra\Testbench\TestCase;
use ZoomInfo\ZoomInfo;

class ZoomInfoTest extends TestCase
{
    public function testAuthentication()
    {
        $zi = new ZoomInfo([]);

        $this->assertTrue($zi != null);
    }
}
