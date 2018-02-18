<?php

namespace Http\Test\Unit;

use PHPO2\Http\Request;
use HttpTest\BaseTest;

class HttpRequestTest extends BaseTest
{
    public function testGetParameter()
    {
        $get = [
            'key1' => 'value1',
        ];

        $post = [
            'key2' => 'value2',
        ];

        $_GET = $get;

        $_POST = $post;

        $request = new Request();

        $this->assertEquals(
            $request->getParameter('key1'), 
            $get['key1']
        );

        $this->assertEquals(
            $request->getParameter('key1', 'defaultValue'), 
            $get['key1']
        );

        $this->assertEquals(
            $request->getParameter('key2'), 
            $post['key2']
        );

        $this->assertEquals(
            $request->getParameter('key3', 'defaultValue'), 
            'defaultValue'
        );

        $this->assertNull($request->getParameter('key3'));
    }
    
    public function testGetQueryParameter()
    {
        $get = [
            'key1' => 'value1',
        ];

        $_GET = $get;

        $request = new Request();

        $this->assertEquals(
            $request->getQueryParameter('key1'), 
            $get['key1']
        );

        $this->assertEquals(
            $request->getQueryParameter('key1', 'defaultValue'), 
            $get['key1']
        );

        $this->assertEquals(
            $request->getQueryParameter('key3', 'defaultValue'), 
            'defaultValue'
        );

        $this->assertNull($request->getQueryParameter('key3'));
    }

    public function testGetBodyParameter()
    {
        $post = [
            'key1' => 'value1',
        ];

        $_POST = $post;

        $request = new Request();

        $this->assertEquals(
            $request->getBodyParameter('key1'), 
            $post['key1']
        );

        $this->assertEquals(
            $request->getBodyParameter('key1', 'defaultValue'), 
            $post['key1']
        );

        $this->assertEquals(
            $request->getBodyParameter('key3', 'defaultValue'), 
            'defaultValue'
        );

        $this->assertNull($request->getQueryParameter('key3'));
    }
    
    public function testGetCookie()
    {
        $cookies = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $_COOKIE = $cookies;

        $request = new Request();

        $this->assertEquals(
            $request->cookie('key1'), 
            $cookies['key1']
        );

        $this->assertEquals(
            $request->cookie('key1', 'defaultValue'), 
            $cookies['key1']
        );

        $this->assertEquals(
            $request->cookie('key2'), 
            $cookies['key2']
        );

        $this->assertEquals(
            $request->cookie('key3', 'defaultValue'), 
            'defaultValue'
        );

        $this->assertNull($request->cookie('key3'));
    }

    public function testGetFile()
    {
        $files = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $_FILES = $files;

        $request = new Request();

        $this->assertEquals(
            $request->getFile('key1'), 
            $files['key1']
        );

        $this->assertEquals(
            $request->getFile('key1', 'defaultValue'), 
            $files['key1']
        );

        $this->assertEquals(
            $request->getFile('key2'), 
            $files['key2']
        );

        $this->assertEquals(
            $request->getFile('key3', 'defaultValue'), 
            'defaultValue'
        );

        $this->assertNull($request->getFile('key3'));
    }

    public function testGetParameters()
    {
        $get = ['key1' => 'value1'];

        $_GET = $get;

        $request = new Request();

        $this->assertEquals(
            $request->getParameters(), 
            $get
        );
    }
    
    public function testGetQueryParameters()
    {
        $get = ['key1' => 'value1'];

        $_GET = $get;

        $request = new Request();

        $this->assertEquals(
            $request->getQueryParameters(), 
            $get
        );
    }
    
    public function testGetBodyParameters()
    {
        $post = ['key1' => 'value1'];

        $_POST = $post;

        $request = new Request();

        $this->assertEquals(
            $request->getBodyParameters(), 
            $post
        );
    }

    public function testGetCookies()
    {
        $cookies = ['key1' => 'value1'];

        $_COOKIE = $cookies;

        $request = new Request();

        $this->assertEquals(
            $request->getCookies(), 
            $cookies
        );
    }

    public function testGetFiles()
    {
        $files = ['key1' => 'value1'];

        $_FILES = $files;

        $request = new Request();

        $this->assertEquals(
            $request->getFiles(), 
            $files
        );
    }

    public function testGetMethod()
    {
        $server = ['REQUEST_METHOD' => 'POST'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getMethod(), 
            $server['REQUEST_METHOD']
        );
    }

    /**
     * @expectedException PHPO2\Http\Exceptions\MissingRequestMetaVariableException
     */
    public function testGetMethodException()
    {
        $request = new Request();
        $request->getMethod();
    }

    public function testGetUri()
    {
        $server = ['REQUEST_URI' => '/test?abc=def'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getUri(), 
            $server['REQUEST_URI']
        );

        $server = ['REQUEST_URI' => '/test'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getUri(), 
            $server['REQUEST_URI']
        );
    }

    /**
     * @expectedException PHPO2\Http\Exceptions\MissingRequestMetaVariableException
     */
    public function testGetUriException()
    {
        $request = new Request();
        $request->getUri();
    }

    public function testGetPath()
    {
        $server = ['REQUEST_URI' => '/test?abc=def'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getPath(), 
            '/test'
        );

        $server = ['REQUEST_URI' => '/test'];

        $request = new Request();

        $this->assertEquals(
            $request->getPath(), 
            '/test'
        );
    }

    public function testGetHttpAccept()
    {
        $server = ['HTTP_ACCEPT' => 'Accept: audio/*; q=0.2, audio/basic'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getHttpAccept(), 
            $server['HTTP_ACCEPT']
        );
    }

    /**
     * @expectedException PHPO2\Http\Exceptions\MissingRequestMetaVariableException
     */
    public function testGetHttpAcceptException()
    {
        $request = new Request();
        $request->getHttpAccept();
    }

    public function testGetReferer()
    {
        $server = ['HTTP_REFERER' => 'http://www.example.com/abc?s=a&b=c'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getReferer(),
            $server['HTTP_REFERER']
        );
    }

    /**
     * @expectedException PHPO2\Http\Exceptions\MissingRequestMetaVariableException
     */
    public function testGetRefererException()
    {
        $request = new Request();
        $request->getReferer();
    }

    public function testGetUserAgent()
    {
        $server = ['HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getUserAgent(), 
            $server['HTTP_USER_AGENT']
        );
    }

    /**
     * @expectedException PHPO2\Http\Exceptions\MissingRequestMetaVariableException
     */
    public function testGetUserAgentException()
    {
        $request = new Request();
        $request->getUserAgent();
    }

    public function testGetIpAddress()
    {
        $server = ['REMOTE_ADDR' => '127.0.0.1'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getIpAddress(), 
            $server['REMOTE_ADDR']
        );
    }

    /**
     * @expectedException PHPO2\Http\Exceptions\MissingRequestMetaVariableException
     */
    public function testGetIpAddressException()
    {
        $request = new Request();
        $request->getIpAddress();
    }

    public function testIsSecure()
    {   
        $_SERVER['HTTPS'] = 'off';

        $request = new Request();
        $this->assertFalse($request->isSecure());

        $_SERVER['HTTPS'] = 'off';

        $request = new Request();
        $this->assertFalse($request->isSecure());

        $_SERVER['HTTPS'] = 'on';
        $request = new Request();
        $this->assertTrue($request->isSecure());
    }

    public function testGetQueryString()
    {
        $server = ['QUERY_STRING' => '/over/there?name=ferret'];

        $_SERVER = $server;

        $request = new Request();

        $this->assertEquals(
            $request->getQueryString(), 
            $server['QUERY_STRING']
        );
    }

    /**
     * @expectedException PHPO2\Http\Exceptions\MissingRequestMetaVariableException
     */
    public function testGetQueryStringException()
    {
        $request = new Request();
        $request->getQueryString();
    }
}
