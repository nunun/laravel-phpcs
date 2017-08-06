# Laravel PHPCS

artisan に phpcs コマンドを追加します。

## 使い方

```sh
> php artisan phpcs
```

phpcs\:fix  とすると、phpcbf を使ってコード修正を行います。

```sh
> php artisan phpcs:fix
```

**↓まずはインストールを実施して下さい↓**


## インストール

composer からパッケージをインストール。

```sh
> composer require nunun/laravel-phpcs
```

次に config/app.php にプロバイダを書き足します。

```
    'providers' => [
        ...
        LaravelPHPCS\PHPCSProvider::class
```

artisan で phpcs コマンドが出てきたら、インストール完了です。

```sh
> php artisan
...
  phpcs                   Check syntax errors via PHPCS
...
```

