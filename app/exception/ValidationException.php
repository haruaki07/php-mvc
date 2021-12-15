<?php

namespace Haruaki07\CompanyProfile\Exception;

class ValidationException extends \Exception
{
	public $errors = [];
	public $message;

	/**
	 * validation error
	 * @param array  $errors
	 * @param string $message
	 */
	public function __construct(
		array $errors,
		string $message = "The given data was invalid."
	) {
		$this->errors = $errors;
		$this->message = $message;
	}

	public function toArray($code = 400)
	{
		$result = [
			"errors" => $this->errors,
			"message" => $this->message
		];

		if (!$code === false) $result["code"] = $code;

		return $result;
	}
}
