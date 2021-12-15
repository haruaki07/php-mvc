<?php

namespace App\Traits;

trait WithResponse
{
	private function header(string $key, string $value)
	{
		header("$key: $value");
	}

	public function response(string $body = "", int $statusCode = 200)
	{
		http_response_code($statusCode);
		echo $body;
	}

	public function json($data = [], int $statusCode = 200)
	{
		$this->header("Content-Type", "application/json");

		http_response_code($statusCode);
		echo json_encode($data);
	}
}
