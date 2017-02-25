<?php

namespace WArk\Minio;

use Aws\S3\S3Client;
class MinioStorage
{
	private $bucket;
	private $endpoint;
	private $key;
	private $secret;
	private $objS3;

	public function __construct()
	{
		$this->bucket = config('miniostorage.bucket');
		$this->endpoint = config('miniostorage.endpoint');
		$this->key = config('miniostorage.key');
		$this->secret = config('miniostorage.secret');
		$this->objS3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'endpoint' => $this->endpoint,
            'credentials' => [
                'key'    => $this->key,
                'secret' => $this->secret,
            ],
        ]);
	}

	public function storeWithBucket($bucket, $key, $object, $bIsRawData = false)
	{
		return $this->objS3->putObject([
            'Bucket' => $bucket,
            'Key'    => $key,
            'Body'   => $bIsRawData?$object:file_get_contents($object)
        ]);
	}

	public function store($key, $object, $bIsRawData = false)
	{
		return $this->storeWithBucket($this->bucket, $key, $object, $bIsRawData);
	}

	public function get($key, $rename = null)
	{
		return $this->getWithBucket($this->bucket, $key, $rename);
	}

	public function getWithBucket($bucket, $key, $saveAs = null)
	{
		$args = [
	            'Bucket' => $bucket,
	            'Key'    => $key
	        ];

		if (!empty($saveAs))
		{	
			$args['SaveAs'] = $saveAs;
		}

		$retrieve = $this->objS3->getObject($args);
		if (!empty($retrieve))
        {
			return $retrieve['Body'];
		}

		return null;
	}

	public function listObjects()
	{
		return $this->listObjectsWithBucket($this->bucket);
	}

	public function listObjectsWithBucket($bucket)
	{
		$objects = $this->objS3->listObjects([
            'Bucket' => $bucket
        ]);

		if (!empty($objects))
        {
			return $objects['Contents'];
		}

		return null;
	}

	public function listObjectsV2()
	{
		return $this->listObjectsWithBucketV2($this->bucket);
	}

	public function listObjectsWithBucketV2($bucket)
	{
		$objects = $this->objS3->listObjectsV2([
            'Bucket' => $bucket
        ]);

		if (!empty($objects))
        {
			return $objects['Contents'];
		}

		return null;
	}

	public function listBuckets()
	{
        $buckets = $this->objS3->listBuckets();

        if (!empty($buckets))
        {
			return $buckets['Buckets'];
        }        

        return null;
	}

	public function copyObject($key, $toBucket, $toKey)
	{
        return $this->copyObjectFrom($this->bucket, $key, $toBucket, $toKey);
	}

	public function copyObjectFrom($bucket, $key, $toBucket, $toKey)
	{
        $result = $this->objS3->copyObject([
            'Bucket' => $toBucket,
            'CopySource'    => "$bucket/$key",
            'Key' => $toKey
        ]);

        return $result;
	}

	public function createBucket($bucket)
	{
		 return $this->objS3->createBucket([
            'Bucket' =>  $bucket
            ]);
	}

	public function createBucketAsync($bucket)
	{
		 return $this->objS3->createBucketAsync([
            'Bucket' =>  $bucket
            ]);
	}

	public function removeBucket($bucket)
	{
		 return $this->objS3->deleteBucket([
            'Bucket' =>  $bucket
            ]);
	}

	public function removeBucketAsync($bucket)
	{
		 return $this->objS3->deleteBucketAsync([
            'Bucket' =>  $bucket
            ]);
	}

	public function removeObject($key)
	{
        return $this->removeObjectWithBucket($this->bucket, $key);
	}

	public function removeObjectWithBucket($bucket, $key)
	{
		$result = $this->objS3->deleteObject([
            'Bucket' => $bucket,
            "Key"=> $key
        ]);

        return $result;
	}

	public function removeObjects($keys)
	{
		return $this->removeObjectsWithBucket($this->bucket, $keys);
	}

	public function removeObjectsWithBucket($bucket, $keys)
	{
		$objects = array();

		foreach ($keys as $onekey) {
			$objects[] = [
				"Key" => $onekey
			];
		}

		return $this->objS3->deleteObjects([
            'Bucket' => $bucket,
            'Delete' => ["Objects"=> $objects]
        ]);
	}
}