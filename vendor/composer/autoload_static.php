<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdb9c3eee2d11cf540452a3b23569cd87
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdb9c3eee2d11cf540452a3b23569cd87::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdb9c3eee2d11cf540452a3b23569cd87::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
