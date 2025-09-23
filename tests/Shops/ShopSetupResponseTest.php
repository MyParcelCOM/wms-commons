<?php

declare(strict_types=1);

namespace Shops;

use MyParcelCom\Wms\Shop\Http\Responses\ShopSetupResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;
use Illuminate\Http\Request;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class ShopSetupResponseTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    #[DataProvider('setupProvider')]
    public function test_to_response(
        ?string $authorizationUrl,
        bool $showConfiguration,
        array $responseData,
    ): void {
        assertSame(
            $responseData,
            new ShopSetupResponse($authorizationUrl, $showConfiguration)
                ->toResponse(Mockery::mock(Request::class))
                ->getData(true),
        );
    }

    public static function setupProvider(): array
    {
        return [
            [
                'authorizationUrl'  => null,
                'showConfiguration' => false,
                'responseData'      => [
                    'data' => [
                        'show_configuration' => false,
                    ],
                ],
            ],
            [
                'authorizationUrl'  => null,
                'showConfiguration' => true,
                'responseData'      => [
                    'data' => [
                        'show_configuration' => true,
                    ],
                ],
            ],
            [
                'authorizationUrl'  => 'http://localhost',
                'showConfiguration' => false,
                'responseData'      => [
                    'data' => [
                        'show_configuration' => false,
                        'authorization_url'  => 'http://localhost',
                    ],
                ],
            ],
        ];
    }
}
