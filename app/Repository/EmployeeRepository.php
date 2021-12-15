<?php

namespace App\Repository;

use App\Core\Database;
use App\Domain\Employee;
use PDO;

class EmployeeRepository
{
	protected ?PDO $conn;

	function __construct()
	{
		$this->conn = Database::getConnection();
	}

	public function all()
	{
		$stmt = $this->conn->prepare("SELECT * FROM employees");
		$stmt->execute();

		$result = [];

		if ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$employee = new Employee;
			$employee->id = $row->id;
			$employee->name = $row->name;

			array_push($result, $employee);
		}

		$stmt->closeCursor();

		return $result;
	}
}
