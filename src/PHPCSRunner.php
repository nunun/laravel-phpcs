<?php

namespace LaravelPHPCS;

class PHPCSRunner
{
    /**
     * PHPCS を実行して、コードエラーをチェックします。
     *
     * @return なし
     */
    public static function check($artisan)
    {
        $config = PHPCSRunner::getConfig();
        system($config['php']. ' '. $config['phpcs']. ' '. $config['args'], $retval);
        if ($retval == 0) {
            $artisan->info('エラーなし。');
        }
    }

    /**
     * PHPCBF を実行して、 コードエラーを修正します。
     *
     * @return なし
     */
    public static function fix($artisan)
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
        Artisan::command('phpcs', function () {
            PHPCSRunner::check($this);
        })->describe('phpcs を実行します。');

        Artisan::command('phpcs:fix', function () {
            PHPCSRunner::fix($this);
        })->describe('phpcbf を使用してコード修正を試みます。');
    }
}
