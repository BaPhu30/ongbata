<?php 
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Awss3 {

    protected $bucket;

    protected $s3Config;

    public $pathS3;

    public function __construct()
    {
        $this->bucket = 'datdia';
        $this->s3Config = new S3Client([
            'region'  => 'ap-southeast-1',
            'version' => '2006-03-01',
            'credentials' => [
                'key'    => 'AKIAVJH5OBNALLPJXXNB',
                'secret' => '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'
            ]
        ]);
        $this->pathS3 = 'https://s3.ap-southeast-1.amazonaws.com';
    }

    public function upload($file, $forder)
    {
        try {
            $pathFile = $file['tmp_name'];
            $key     = $forder . '/' . $file['name'];
            $this->s3Config->putObject(
                array(
                    'Bucket'=> $this->bucket,
                    'Key' =>  $key,
                    'SourceFile' => $pathFile,
                    'ACL'           => 'public-read',
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function uploadWithTmpFile($file, $pathFile)
    {
        try {
            $this->s3Config->putObject(
                array(
                    'Bucket'=> $this->bucket,
                    'Key' =>  $pathFile,
                    'SourceFile' => $file,
                    'ACL'           => 'public-read',
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getUrl($fileName, $forder)
    {
        $key = $forder . '/' . $fileName;
        return $this->s3Config->getObjectUrl($this->bucket, $key) ?? false;
    }
}