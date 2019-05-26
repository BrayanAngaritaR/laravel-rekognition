<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Aws\Rekognition\RekognitionClient;

class AWS extends Model
{
   public function getClient()
   {
   	$client = new RekognitionClient([
		   'region'    => env('AWS_DEFAULT_REGION'),
		   'version'   => 'latest'
		]);
   }
}
