<?php
/**
 * Spotify API PHP Wrapper
 *
 * @version 1.0.0
 * @author Travis Aaron Wagner <travis@travisaw.com>
 * @see https://developer.spotify.com/documentation/web-api/reference/
 */
class Spotify {
	/** @var string Authorized Spotify API token */
	private $token;

	/**
	 * Constructor
	 *
	 * @param string $client_id Client ID
	 * @param string $client_secret Client secret
	 */
	public function __construct($client_id, $client_secret) {
		$headers  = [
			'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
		];
		$url      = 'https://accounts.spotify.com/api/token';
		$options  = [
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_POST           => TRUE,
			CURLOPT_POSTFIELDS     => 'grant_type=client_credentials',
			CURLOPT_HTTPHEADER     => $headers
		];
		$credentials = $this->call($options); 
		$this->token = $credentials->access_token;
	}

	/**
	 * API Call
	 *
	 * @param array $options cURL options array
	 * @return mixed Response data or error array
	 */
	private function call($options) {
		$curl  = curl_init();
		curl_setopt_array($curl, $options); 
		$json  = curl_exec($curl);
		$error = curl_error($curl);
		curl_close($curl);
		if ($error) {
			return [
				'error'   => TRUE,
				'message' => $error
			];
		}
		$data = json_decode($json);
		if (is_null($data)) {
			return [
				'error'   => TRUE,
				'message' => json_last_error_msg()
			];
		}
		return $data; 
	}

	/**
	 * API Get Request
	 *
	 * @param string $endpoint API endpoint
	 * @param string $id (optional) ID to pass to endpoint
	 * @return mixed Response data or error array
	 */
	public function get($endpoint, $id = '') {
		$headers  = [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token,
		];
		$id = $id ? '/' . ltrim($id, '/') : '';
		$url      = 'https://api.spotify.com/v1/' . $endpoint . $id;
		$options  = [
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_FOLLOWLOCATION => TRUE,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'GET',
			CURLOPT_HTTPHEADER     => $headers
		];
		$response = $this->call($options); 
		return $response;
	}
}
