<?php

namespace Via\LaravelSovren\Tests;

use GuzzleHttp\Client;
use Via\LaravelSovren\Facade\Sovren as SovrenFacade;
use Via\LaravelSovren\Sovren;
use Orchestra\Testbench\TestCase;
use Via\LaravelSovren\SovrenServiceProvider;

class SovrenTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [SovrenServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return ['laravel-sovren' => Sovren::class];
    }

    /**
     * @vcr get_account.yml
     * @test
     */
    public function get_account_info(): void
    {
        $response = SovrenFacade::getAccount();
        $this->assertEquals('Success', $response['Info']['Code']);
    }

    /**
     * @vcr parse_resume.yml
     * @test
     */
    public function parse_resume(): void
    {
        $file = file_get_contents('tests/files/resume.pdf');
        $resume = SovrenFacade::parse($file);


        $this->assertCount(3, $resume);
        $this->assertArrayHasKey('StructuredXMLResume', $resume);
    }

    /**
     * @vcr wrong_account_parse_resume.yml
     * @test
     */
    public function wrong_account_parse_resume(): void
    {
        $file = file_get_contents('tests/files/resume.pdf');

        $client = new Client([
            'base_uri' => config('sovren.sovren-base-uri'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Sovren-AccountId' => '123456789',
                'Sovren-ServiceKey' => config('sovren.sovren-servicekey'),
            ]
        ]);

        $resume = (new Sovren($client))->parse($file);
        $this->assertNotEquals('Success', $resume['Info']['Code']);
    }
}
