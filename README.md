# WArk-MinioStorage

## Installation

Open the command prompt and type in the following. This will download the package.
```php
composer require wark/miniostorage
```

After that, add the ServiceProvider to the providers array in `config/app.php`

```php
WArk\Minio\Providers\MinioStorageServiceProvider::class,
```

You can use the facade for shorter code. Add this to your aliases:

```php
'MinioStorage' => WArk\Minio\Facades\MinioStorage::class,
```

To publish the config settings in Laravel 5 use:
```php
php artisan vendor:publish
```

This will add an miniostorage.php config file to your config folder.

in .env fill in the following fields：
```php
MINIO_ACCESS_KEY=<access_key>
MINIO_ACCESS_SECRET=<access_secret>
MINIO_ACCESS_REGION=null
MINIO_BUCKET_NAME=<bucket>
MINIO_ACCESS_ENDPOINT=http://localhost:9000
```
