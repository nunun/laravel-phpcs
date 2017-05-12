<?php
namespace LaravelPHPCS;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class PHPCSProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapConsoleRoutes();
    }

    /**
     * Define the "console" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapConsoleRoutes()
    {
        \Artisan::command('phpcs', function () {
            PHPCSProvider::check();
        })->describe('Check syntax errors via PHPCS');

        \Artisan::command('phpcs:fix', function () {
            PHPCSProvider::fix();
        })->describe('Fix syntax errors via PHPCBF');
    }

    /**
     * PHPCS を実行して、コードエラーをチェックします。
     *
     * @return なし
     */
    public static function check()
    {
        $config = PHPCSProvider::getConfig();
        system($config['php']. ' '. $config['phpcs']. ' '. $config['args'], $retval);
        if ($retval == 0) {
            echo('エラーなし。'. "\n");
        }
    }

    /**
     * PHPCBF を実行して、 コードエラーを修正します。
     *
     * @return なし
     */
    public static function fix()
    {
        $config = PHPCSProvider::getConfig();
        system($config['php']. ' '. $config['phpcbf']. ' '. $config['args'], $retval);
    }

    /**
     * 設定
     *
     * @return なし
     */
    static function getConfig() {
        return [
            'php'    => 'php',
            'phpcs'  => base_path('vendor/squizlabs/php_codesniffer/scripts/phpcs'),
            'phpcbf' => base_path('vendor/squizlabs/php_codesniffer/scripts/phpcbf'),
            'args'   => '--standard="'. base_path('phpcs.xml'). '" --extensions=php .',
        ];
    }
}
