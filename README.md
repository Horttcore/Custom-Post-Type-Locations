# Custom Post Type Locations

A custom post type to manage locations

## Supports

* Title
* Editor
* Excerpt
* Thumbnail

## Custom Fields

* Street
* Street number
* ZIP
* City
* Address additional
* Region
* Country
* Latitude / Longitdude ( Google Maps GeoAPI )

## Language Support

* english
* german

## Hooks

### Actions

* `location-table-before` - Before the location table
* `location-table-first` - Before the first row of the location table
* `location-table-last` - After the last row of the location table
* `location-table-after` - After the location table
* `save-location-meta` - Runs when the locationnt of interes location is saved; Location is passed as argument

### Filter

* `location` - Get the location data
* `location-save` - The location data that is saved into post_meta
* `location-get-lat-lng` - Get latitude longitude

## Changelog

### v0.4

* Refactoring

### v0.3

* Added hook: `location-get-lat-lng`
* Enhancement: Cleanup

### v0.2

* Enhancement: Manual location check
* Bugfix: GeoAPI was not saved.

### v0.1

* Initial release
