<?php

namespace Http\Test\Unit;

use PHPO2\Http\CookieBuilder;
use HttpTest\BaseTest;

class CookieBuilderTest extends BaseTest
{
    public function testSetDefaultDomain()
    {
        $builder = new CookieBuilder;
        $builder->setDefaultDomain('.example.com');

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf('PHPO2\Http\HttpCookie', $cookie);

        $this->assertEquals(
            'name=value; domain=.example.com; path=/; secure; HttpOnly', 
            $cookie->getHeaderString()
        );
    }

    public function testSetDefaultPath()
    {
        $builder = new CookieBuilder;
        $builder->setDefaultPath('/test');

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf('PHPO2\Http\HttpCookie', $cookie);

        $this->assertEquals(
            'name=value; path=/test; secure; HttpOnly', 
            $cookie->getHeaderString()
        );
    }

    public function testSetDefaultSecure()
    {
        $builder = new CookieBuilder;
        $builder->setDefaultSecure(true);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf('PHPO2\Http\HttpCookie', $cookie);

        $this->assertEquals(
            'name=value; path=/; secure; HttpOnly', 
            $cookie->getHeaderString()
        );

        $builder->setDefaultSecure(false);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf('PHPO2\Http\HttpCookie', $cookie);

        $this->assertEquals(
            'name=value; path=/; HttpOnly', 
            $cookie->getHeaderString()
        );
    }

    public function testSetDefaultHttpOnly()
    {
        $builder = new CookieBuilder;
        $builder->setDefaultHttpOnly(true);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf('PHPO2\Http\HttpCookie', $cookie);

        $this->assertEquals(
            'name=value; path=/; secure; HttpOnly', 
            $cookie->getHeaderString()
        );

        $builder->setDefaultHttpOnly(false);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf('PHPO2\Http\HttpCookie', $cookie);

        $this->assertEquals(
            'name=value; path=/; secure', 
            $cookie->getHeaderString()
        );
    }

    public function testBuild()
    {
        $builder = new CookieBuilder;

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf('PHPO2\Http\HttpCookie', $cookie);

        $this->assertEquals(
            'name=value; path=/; secure; HttpOnly', 
            $cookie->getHeaderString()
        );
    }
}