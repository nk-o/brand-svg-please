# Brand SVG Please

Work with brand SVG icons in WordPress themes and plugins.

## Examples

### Get brand SVG string

```php
$icon = Brand_SVG_Please::get( 'facebook' );
```

### Get brand name string

```php
$name = Brand_SVG_Please::get_name( 'facebook' );
// returns 'Facebook'
```

### Check if brand exists

```php
if ( Brand_SVG_Please::exists( 'facebook' ) ) {
    ...
}
```

### Print brand SVG icon

Auto:

```php
Brand_SVG_Please::get_e( 'facebook' );
```

Manual:

```php
if ( Brand_SVG_Please::exists( 'facebook' ) ) {
    $icon = Brand_SVG_Please::get( 'facebook' );
    echo wp_kses( $icon, Brand_SVG_Please::kses() );
}
```

### Get all available brands

```php
$brands = Brand_SVG_Please::get_all_brands();
```

## Thanks

Thanks to FontAwesome team for the great SVG icons <https://github.com/FortAwesome/Font-Awesome/tree/6.x/free/svgs/brands>
