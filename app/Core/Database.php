<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
	protected static ?PDO $pdo = null;

	public static function getConnection()
	{
		if (self::$pdo === null) {
			try {
				$dsn = config("database.driver");
				$dsn .= ":host=" . config("database.host");
				$dsn .= ";port=" . config("database.port");
				$dsn .= ";dbname=" . config("database.name");

				self::$pdo = new PDO(
					$dsn,
					config("database.username"),
					config("database.password")
				);

				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				die("DB connection error, " . $e->getMessage());
			}
		}

		return self::$pdo;
	}
}
