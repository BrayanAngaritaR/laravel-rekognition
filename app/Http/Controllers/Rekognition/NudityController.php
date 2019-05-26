<?php

namespace App\Http\Controllers\Rekognition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aws\Rekognition\RekognitionClient;

class NudityController extends Controller
{
   public function index()
	{
		return view('rekognition.nudity');
	}

	public function submitForm(Request $request)
	{
		$client = new RekognitionClient([
		   'region'    => env('AWS_DEFAULT_REGION'),
		   'version'   => 'latest'
		]);

		$image = fopen($request->file('photo')->getPathName(), 'r');
		$bytes = fread($image, $request->file('photo')->getSize());

		$results = $client->detectModerationLabels([
			'Image' => 
			['Bytes' => $bytes],
			'MinConfidence' => intval($request->input('confidence'))
		])
		['ModerationLabels'];

		if(in_array('Explicit Nudity', array_column($results, 'Name')))
		{
			$message = 'Esta imagen puede contener desnudez';
			$alert = 'warning';
		}
		else
		{
			$message = 'Esta imagen NO contiene desnudez';
			$alert = 'success';
		}

		request()->session()->flash('info', [$alert, $message]);
		return view('rekognition.nudity', compact('results'));
	}
}
