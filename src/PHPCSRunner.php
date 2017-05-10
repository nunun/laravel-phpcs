<?php

namespace LaravelPHPCS;

class PHPCSRunner
{
    /**
     * PHPCS を実行して、コードエラーをチェックします。
     *
     * @return なし
     */
    public static function check()
    {
        $config = PHPCSRunner::getConfig();
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
        $config = PHPCSRunner::getConfig();
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

    /**
     * コマンド経路
     *
     * @return なし
     */
    static function commands() {
        \Artisan::command('phpcs', function () {
            PHPCSRunner::check();
        })->describe('Check syntax errors via PHPCS');

        \Artisan::command('phpcs:fix', function () {
            PHPCSRunner::fix();
        })->describe('Fix syntax errors via PHPCBF');
    }
}
