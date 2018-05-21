<?php

namespace Spatie\Html\Test\Html;

use Mockery;
use Spatie\Html\Html;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Spatie\Html\Test\Concerns\AssertsHtmlStrings;

abstract class TestCase extends \Spatie\Html\Test\TestCase
{
    use AssertsHtmlStrings;

    /** @var \Mockery\MockInterface */
    protected $request;

    /** @var array */
    protected $session = [];

    /** @var \Spatie\Html\Html $html */
    protected $html;

    public function setUp()
    {
        parent::setUp();

        $this->request = Mockery::mock(Request::class);

        $this->request
            ->shouldReceive('old')
            ->withAnyArgs()
            ->andReturnUsing(function ($key, $value = null) {
                return isset($this->session[$key]) ? $this->session[$key] : $value;
            });

        $session = Mockery::mock(Session::class)
            ->shouldReceive('token')
            ->andReturn('abc');

        $this->request
            ->shouldReceive('session')
            ->andReturn($session->getMock());

        $this->html = new Html($this->request);
    }

    protected function withModel(array $model)
    {
        $this->html->model($model);

        return $this;
    }

    protected function withSession(array $session)
    {
        $this->session = $session;

        return $this;
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
