<?php

namespace App\Service;

use App\Repository\EmployeeRepository;

class EmployeeService
{
	protected EmployeeRepository $employeeRepository;

	function __construct()
	{
		$this->employeeRepository = new EmployeeRepository();
	}

	public function getAll(): array
	{
		return $this->employeeRepository->all();
	}
}
