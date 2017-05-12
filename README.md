# Laravel PHPCS

artisan に phpcs コマンドを追加します。

## 使い方

```sh
php artisan phpcs
```

phpcs\:fix  とすると、phpcbf を使ってコード修正を行います。

```sh
php artisan phpcs:fix
```

**↓まずはインストールを実施して下さい↓**


## インストール


次に開発中の Laravel アプリの composer.json に以下を記述。

```
    "repositories": [
      { "type": "vcs", "url": "http://github.com/nunun/laravel-phpcs" }
    ],
    "require": {
        "nunun/laravel-phpcs": "master@dev"
    },
```

書き終わったらパッケージ更新。

```sh
composer update
```

最後に config/app.php にプロバイダを書き足します。

```
    'providers' => [
        ...
        LaravelPHPCS\PHPCSProvider::class
```

artisan で phpcs コマンドが出てきたら、インストール完了です。

```sh
php artisan list
...
  phpcs                   Check syntax errors via PHPCS
...
```
