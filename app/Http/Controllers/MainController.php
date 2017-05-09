<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Contracts\FeedReader;

class MainController extends Controller
{

	public function __construct(JsonResponse $response)
	{
		$this->response = $response;
	}

	public function index()
	{
		return view('main', [
			
			'yt_item' => base64_encode(view('yt_item'))
		]); // template for one video item

	}

	/**
	 * Searches videos by search string given
	 *
	 * @param Request $request        	
	 * @param FeedReader $reader        	
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function searchVideos(Request $request, FeedReader $reader)
	{
		$url = config('main-config.youtube-service-url');
		
		if (empty($url)) {
			return $this->response->setData([
				'error' => 'No service url'
			]);
		}
		
		if ($request->has('search_word')) {
			
			$key = config('main-config.youtube-key');
			if (empty($key)) {
				return $this->response->setData([
					'error' => 'No key'
				]);
			}
			
			if (empty($request->search_word)) {
				return $this->response->setData([
					'error' => 'Search word cannot be empty'
				]);
			}
			
			$queryString = [
				'key' => $key, // api key
				'part' => 'snippet', // what fields to return
				'q' => $request->search_word, // user search string
				'type' => 'video', // only videos
				'maxResults' => 15,
				'videoEmbedabble' => true, // return videos that can be embedded
				'order' => 'title'
			]; // max 15 records
			
			$resp = $reader->readJson($url . '?' . http_build_query($queryString));
			if ($reader->getErrorCode()) {
				return $this->response->setData([
					'error' => 'Invalid response'
				]);
			}
			
			if (empty($resp->items)) {
				return $this->response->setData([
					'error' => 'No videos'
				]);
			}
			$this->response->setData($resp);
		} else {
			$this->response->setData([
				'error' => 'No search word'
			]);
		}
		
		return $this->response;
	}
}
