<?php

return [

	/**
	 * API mode
	 * Available: "sandbox", "production"
	 * 
	 * */
	'mode'	=> env('ALMUTASI_MODE', 'sandbox'),

	/**
	 * API Token
	 * Can be found at https://app.almutasi.com/integration
	 * 
	 * */
	'api_token' => env('ALMUTASI_API_TOKEN', ''),

	/**
	 * Private Key
	 * Can be found at https://app.almutasi.com/integration
	 * 
	 * */
	'private_key' => env('ALMUTASI_PRIVATE_KEY', ''),

];