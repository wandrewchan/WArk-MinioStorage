<?php

return [
	'driver' => 'minio',
	'key' => env("MINIO_ACCESS_KEY"),
	'secret' => env("MINIO_ACCESS_SECRET"),
	'region' => env("MINIO_ACCESS_REGION"),
	'bucket' => env("MINIO_BUCKET_NAME"),
	'endpoint' => env("MINIO_ACCESS_ENDPOINT"),
];