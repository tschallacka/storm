<?php

use Winter\Storm\Foundation\Application;
use Winter\Storm\Filesystem\PathResolver;
use Winter\Storm\Support\Helper;

class HelpersTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock application
        $this->app = new Application('/tmp/custom-path');

        // Mock Config facade
        if (!class_exists('Config')) {
            class_alias('Winter\Storm\Support\Facades\Config', 'Config');
        }

        Config::shouldReceive('get')->andreturnUsing(function ($key) {
            switch ($key) {
                case 'cms.storage.uploads.path':
                    return '/storage/app/custom-uploads-path';
                case 'cms.storage.media.path':
                    return '/storage/app/custom-media-path';
            }
        });
    }

    public function testConfigPath()
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $this->markTestIncomplete('Need to fix Windows testing here');
        }

        $this->assertEquals($this->app['path.config'], Helper::configPath());
    }

    public function testPluginsPath()
    {
        $expected = $this->app['path.plugins'];

        $this->assertEquals($expected, Helper::pluginsPath());
        $this->assertEquals(PathResolver::join($expected, '/extra'), Helper::pluginsPath('/extra'));
    }

    public function testThemesPath()
    {
        $expected = $this->app['path.themes'];

        $this->assertEquals($expected, Helper::themesPath());
        $this->assertEquals(PathResolver::join($expected, '/extra'), Helper::themesPath('/extra'));
    }

    public function testTempPath()
    {
        $expected = $this->app['path.temp'];

        $this->assertEquals($expected, Helper::tempPath());
        $this->assertEquals(PathResolver::join($expected, '/extra'), Helper::tempPath('/extra'));
    }

    public function testUploadsPath()
    {
        $expected = PathResolver::standardize(Config::get('cms.storage.uploads.path'));

        $this->assertEquals($expected, Helper::uploadsPath());
        $this->assertEquals(PathResolver::join($expected, '/extra'), Helper::uploadsPath('/extra'));
    }

    public function testMediaPath()
    {
        $expected = PathResolver::standardize(Config::get('cms.storage.media.path'));

        $this->assertEquals($expected, Helper::mediaPath());
        $this->assertEquals(PathResolver::join($expected, '/extra'), Helper::mediaPath('/extra'));
    }
}
