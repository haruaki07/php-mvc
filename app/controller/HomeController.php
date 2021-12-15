<?php

namespace Haruaki07\CompanyProfile\Controller;

use Haruaki07\CompanyProfile\Exception\ValidationException;
use Haruaki07\CompanyProfile\Model\NumberRequest;
use Haruaki07\CompanyProfile\Traits\WithResponse;

class HomeController
{
	use WithResponse;

	public function index()
	{
		return $this->response('<a href="/about">about page</a>');
	}

	public function about()
	{
		$this->response('This is about page');
	}

	public function number($number)
	{
		try {
			$request = new NumberRequest($number);
		} catch (ValidationException $e) {
			return $this->json($e->toArray(), 400);
		}

		$this->json(["message" => "your number is {$request->number}"]);
	}
}
