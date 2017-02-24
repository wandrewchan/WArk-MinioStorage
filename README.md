# WArk-MinioStorage

## Minio Server
You can download the minio oss server from [here](https://github.com/minio/minio).
```
Minio is an object storage server. Size of an object can range from a few KBs to a maximum of 5TB.
It is best suited for storing unstructured data such as photos, videos, log files, backups and container / VM images. 

Minio server is light enough to be bundled with the application stack, similar to NodeJS, Redis and MySQL.
```

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
