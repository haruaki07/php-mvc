<?php

namespace App\Controller;

use App\Exception\ValidationException;
use App\Model\NumberRequest;
use App\Service\EmployeeService;
use App\Traits\WithResponse;

class HomeController
{
	use WithResponse;

	protected EmployeeService $employeeService;

	function __construct()
	{
		$this->employeeService = new EmployeeService();
	}

	public function index()
	{
		$employees = $this->employeeService->getAll();
		$json = json_encode($employees, JSON_PRETTY_PRINT);

		return $this->response(
			<<<END
				<a href="/about">about page</a>
				<h4>Employee List</h4>
				<pre>{$json}</pre>
			END
		);
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
