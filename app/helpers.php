<?php

if (!function_exists('env')) {
	function env(string $key, $default = null)
	{
		if (isset($_ENV[$key])) return $_ENV[$key];

		return $default;
	}
}

if (!function_exists('config')) {
	function config(string $key, $default = null)
	{
		$arrayKey = explode(".", $key);
		$configValues = dot(
			require(__DIR__ . "/../config/" . array_shift($arrayKey) . ".php")
		);
		$key = implode($arrayKey);

		if (!$configValues->isEmpty($key)) return $configValues->get($key);

		return $default;
	}
}
