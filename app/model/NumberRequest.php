<?php

namespace Haruaki07\CompanyProfile\Model;

use Haruaki07\CompanyProfile\Exception\ValidationException;
use Rakit\Validation\Validator;

class NumberRequest
{
	public ?int $number = null;

	public function __construct(int $number)
	{
		$validator = new Validator();

		$validation = $validator->validate(compact('number'), [
			'number' => 'required|integer|min:5'
		]);

		if ($validation->fails()) {
			throw new ValidationException($validation->errors()->firstOfAll());
		}

		$this->number = $number;
	}
}
