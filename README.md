# WArk-MinioStorage
Minio oss filesystem storage for laravel 5+

## Minio Server
You can download the minio oss server from [here](https://github.com/minio/minio).
```
Minio is an object storage server. Size of an object can range from a few KBs to a maximum of 5TB.
It is best suited for storing unstructured data such as photos, videos, log files, backups 
and container / VM images. 

Minio server is light enough to be bundled with the application stack, similar to NodeJS, Redis and MySQL.
```

## Installation

####Open the command prompt and type in the following. This will download the package.
```bat
composer require wark/miniostorage
```

####After that, add the ServiceProvider to the providers array in `config/app.php`

```php
WArk\Minio\Providers\MinioStorageServiceProvider::class,
```

####You can use the facade for shorter code. Add this to your aliases:

```php
'MinioStorage' => WArk\Minio\Facades\MinioStorage::class,
```

####To publish the config settings in Laravel 5 use:
```php
php artisan vendor:publish
```
>This will add an miniostorage.php config file to your config folder.

####Set Environment Variable in `.env` file
```php
MINIO_ACCESS_KEY=<access_key>
MINIO_ACCESS_SECRET=<access_secret>
MINIO_ACCESS_REGION=null
MINIO_BUCKET_NAME=<bucket>
MINIO_ACCESS_ENDPOINT=http://localhost:9000
```

##Usage

Use it like below:
####Save Image/Video/Object

```php
MinioStorage::store('key/key', Input::file('file'));
```

>Use `Input::file('file')` to get the uploaded file and put it directly. `key/key` can be any string.


####Retrieve Image/Video/Object

```php
MinioStorage::get('key/key');
```
>Get the object by key string.

```php
MinioStorage::getWithBucket('key/key');
```
>Specify the bucket and get the object from the bucket.


####List out the objects

```php
MinioStorage::listObjects();
```

####List out the objects with specified bucket

```php
MinioStorage::listObjectsWithBucket();
```
>Specify the bucket and list out the object from the bucket.

####Remove Object

```php
MinioStorage::removeObject('key');
```
>Delete the specified object

####Remove Object with specified bucket

```php
MinioStorage::removeObjectWithBucket('bucket','key');
```
>Delete the specified object with specified bucket

####Create Bucket

```php
MinioStorage::createBucket('bucketName');
```
>Create new bucket

####Create Bucket Async

```php
MinioStorage::createBucketAsync('bucketName');
```
>Create new bucket asynchronously

####Remove Bucket

```php
MinioStorage::removeBucket('bucketName');
```
>Delete the specified bucket

####Remove Bucket Async

```php
MinioStorage::removeBucketAsync('bucketName');
```
>Delete the specified bucket asynchronously

####Copy Object

```php
MinioStorage::copyObject('key', 'toBucketName', 'toKey');
```
>Copy existing object from to another bucket with new key name

####Copy Object From 

```php
MinioStorage::copyObjectFrom('fromBucketName', 'key', 'toBucketName', 'toKey');
```
>Copy object from specified bucket to another bucket with new key name
