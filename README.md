## Vietnam Maps

Database of Vietnam's area.

Data are taken directly from the General Statistics Office of Vietnam.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zmap95/vietnam-maps.svg?style=flat-square)](https://packagist.org/packages/zmap95/vietnam-maps)
[![Total Downloads](https://img.shields.io/packagist/dt/zmap95/vietnam-maps.svg?style=flat-square)](https://packagist.org/packages/zmap95/vietnam-maps)

## Install

```shell
composer require zmap95/vietnam-maps
```

## Extracting

### Method 1:

Extract directly via command: 

```shell
php artisan vietnam-map:install
```

### Method 2:

#### Copy file config và migration

```shell
php artisan vendor:publish --provider="Zmap95\VietnamMap\VietnamMapServiceProvider"
```

#### Customize config và migration

1. Rename table

Open file `config/vietnam-maps.php` and config:

```php
'tables' => [
    'provinces' => 'provinces',
    'districts' => 'districts',
    'wards'     => 'wards',
],
```

2. Rename column

Open file `config/vietnam-maps.php` and config:

```php
'columns' => [
    'name'        => 'name',
    'gso_id'      => 'gso_id',
    'province_id' => 'province_id',
    'district_id' => 'district_id',
],
```

3. Add column

Open the following migration files and customize if you need:

```shell
database/migrations/{datetime}_create_vietnam_maps_table.php
```

#### Run migration

```shell
php artisan migrate
```

#### Download và import into database

```shell
php artisan vietnam-map:download
```

## Usage with Models

1. Get all provinces, districts, wards

```php
    use Zmap95\VietnamMap\Models\Province;
    use Zmap95\VietnamMap\Models\District;
    use Zmap95\VietnamMap\Models\Ward;

   class DevController extends Controller
   {
       ...
       public function dev()
       {
           $provinces = Province::all();
           $districts = District::all();
           $wards = Ward::all();
           ...
       }
   }
```

2. Get data using relationship

```php
    use zmap95\VietnamMap\Models\Province;

   class DevController extends Controller
   {
       ...
       public function dev()
       {
           $province = Province::first();
           $districts = $province->districts;
           ...
       }
   }
```
3. Relation in Province.php

```php
    class Province extends Model
    {
        ...
        public function districts()
        {
            return $this->hasMany(District::class);
        }
    }
```

4. Relation in District.php

```php
    class District extends Model
    {
        ...
        public function province()
        {
            return $this->belongsTo(Province::class, config('vietnam-maps.columns.province_id'), 'id');
        }
        
        public function wards()
        {
            return $this->hasMany(Ward::class);
        }
    }
```

5. Relation in Ward.php

```php
    class Ward extends Model
    {
        ...
        public function district()
        {
            return $this->belongsTo(District::class, config('vietnam-maps.columns.district_id'), 'id');
        }
    }
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## References

1. [General Statistics Office of Vietnam](https://www.gso.gov.vn/dmhc2015)
2. [Vietnam Zone](https://github.com/kjmtrue/vietnam-zone)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
