<?php

declare(strict_types=1);

namespace Tests\Middleware;

use Illuminate\Http\Request;
use MyParcelCom\Wms\Http\Middleware\ForceJsonResponse;
use PHPUnit\Framework\TestCase;

class ForceJsonResponseTest extends TestCase
{
        public function test_middleware_sets_accept_json_header(): void
        {
            $request = new Request();

            $this->assertNull($request->header('Accept'));

            $middleware = new ForceJsonResponse();
            $middleware->handle($request, fn () => null);

            $this->assertEquals('application/json', $request->header('Accept'));
        }
}
