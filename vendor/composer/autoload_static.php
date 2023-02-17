<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d83cc57e06616c32aa04a6ee10765be
{
    public static $files = array (
        'ff4cc5290f0f0f4125c23c8eacbda8cd' => __DIR__ . '/../..' . '/inc/template-tags.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RalfHortt\\TranslatorService\\' => 28,
            'RalfHortt\\ServiceContracts\\' => 27,
            'RalfHortt\\Plugin\\' => 17,
            'RalfHortt\\MetaBoxes\\' => 20,
            'RalfHortt\\MetaBoxAddress\\' => 25,
            'RalfHortt\\CustomPostTypeLocations\\' => 34,
        ),
        'H' => 
        array (
            'Horttcore\\CustomPostType\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RalfHortt\\TranslatorService\\' => 
        array (
            0 => __DIR__ . '/..' . '/ralfhortt/translator-service/src',
        ),
        'RalfHortt\\ServiceContracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/ralfhortt/service-contracts/src',
        ),
        'RalfHortt\\Plugin\\' => 
        array (
            0 => __DIR__ . '/..' . '/ralfhortt/wp-plugin/src',
        ),
        'RalfHortt\\MetaBoxes\\' => 
        array (
            0 => __DIR__ . '/..' . '/ralfhortt/wp-meta-box/src',
        ),
        'RalfHortt\\MetaBoxAddress\\' => 
        array (
            0 => __DIR__ . '/..' . '/ralfhortt/wp-meta-box-address/src',
        ),
        'RalfHortt\\CustomPostTypeLocations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Horttcore\\CustomPostType\\' => 
        array (
            0 => __DIR__ . '/..' . '/horttcore/wp-custom-post-type/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d83cc57e06616c32aa04a6ee10765be::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d83cc57e06616c32aa04a6ee10765be::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6d83cc57e06616c32aa04a6ee10765be::$classMap;

        }, null, ClassLoader::class);
    }
}
