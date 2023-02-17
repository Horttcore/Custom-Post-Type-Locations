# WordPress Meta Box Address data

Adding address data fields as a meta box

- Street / Streetnumber
- ZIP code / City
- Address Additionall
- Country
- Map

## Installation

`composer require ralfhortt/wp-meta-box-address`

## Usage

```php
/*
new MetaBoxAddress(
    array $screen = ['post'],
    string $context = 'advanced',
    string $priority = 'default'
)
*/
```

### Serviceloader

```php
use RalfHortt\MetaBoxAddress\MetaBoxAddress;

PluginFactory::create()
    ->addService(MetaBoxAddress::class, ['page'], 'advanced', 'default')
    ->boot();
```

### Standalone

```php
use RalfHortt\MetaBoxAddress\MetaBoxAddress;

(new MetaBoxAddress(['page'], 'advanced', 'default' ))->register();
```

## Hooks

### Filter

- `wp-meta-box-address/meta-box-identifier` - Change meta box id
- `wp-meta-box-address/meta-box-label` - Change meta box label
- `wp-meta-box-address/street-{$postType}` - Hide street field for \$postType
- `wp-meta-box-address/streetnumber-{$postType}` - Hide streetnumber field for \$postType
- `wp-meta-box-address/address-additional-{$postType}` - Hide address additional field for \$postType
- `wp-meta-box-address/zip-{$postType}` - Hide zip field for \$postType
- `wp-meta-box-address/city-{$postType}` - Hide city field for \$postType
- `wp-meta-box-address/country-{$postType}` - Hide country field for \$postType
- `wp-meta-box-address/latitude-{$postType}` - Hide latitude field for \$postType
- `wp-meta-box-address/longitude-{$postType}` - Hide longitude field for \$postType

#### Example

```php
<?php
add_filter('wp-meta-box-address/country-post', '__return_false');
```

## Action

- `wp-meta-box-address/before` - Add fields before the street field
- `wp-meta-box-address/after` - Add fields after the country field
- `wp-meta-box-address/save` - Save custom fields

## ToDo

- Geocode address
- Template tags

## Changelog


### 2.1 - 2020-11-23

- Updating wp-meta-box dependency

### 2.0 - 2020-11-06

- Updating wp-meta-box dependency
- Adding translation
- Fix error in composer.json

### 1.1.0 - 2020-01-28

- Adding latitude meta field
- Adding longitude meta field

### 1.0.0 - 2020-01-14

- Initial release
