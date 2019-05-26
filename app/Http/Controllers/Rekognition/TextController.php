<?php

namespace App\Http\Controllers\Rekognition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aws\Rekognition\RekognitionClient;

class TextController extends Controller
{

	public function index()
	{
		return view('rekognition.text');
	}


	public function submitForm(Request $request)
	{
		$client = new RekognitionClient([
		   'region'    => env('AWS_DEFAULT_REGION'),
		   'version'   => 'latest'
		]);

		$image = fopen($request->file('photo')->getPathName(), 'r');
		$bytes = fread($image, $request->file('photo')->getSize());
	
	   $results = $client->detectText(['Image' => ['Bytes' => $bytes], 'MinConfidence' => intval($request->input('confidence'))])['TextDetections'];
	   $string = '';

	   foreach($results as $item)
	   {
			if($item['Type'] === 'WORD')
			{
				$string .= $item['DetectedText'] . ' ';
			}
	   }

	   if(empty($string))
	   {
			$message = 'Esta imagen no contiene texto';
			$alert = 'warning';
	   }
	   else
	   {
	      $message = 'Se ha encontrado texto dentro de la imagen';
	      $alert = 'success';
	   }

	   request()->session()->flash('info', [$alert, $message]);
		return view('rekognition.text', compact('results'));
	}
	// request()->session()->flash('success', $message);
	// return view('rekognition.image_to_text', ['results' => $results]);
	// }
}
