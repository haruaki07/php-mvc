<?php

namespace Haruaki07\CompanyProfile\Core;

use \Error;

/**
 * @method static void get(string $path, array $handler, array $middlewares = []): void
 * @method static void post(string $path, array $handler, array $middlewares = []): void
 * @method static void del(string $path, array $handler, array $middlewares = []): void
 * @method static void put(string $path, array $handler, array $middlewares = []): void
 */
class Router
{
	// List of allowed request method
	private static array $allowedMethods = [
		"get" => "GET",
		"post" => "POST",
		"del" => "DELETE",
		"put" => "PUT"
	];

	// List registered routes
	private static array $routes = [];

	public static function __callStatic($func, $params)
	{
		$requestMethodKeys = array_keys(self::$allowedMethods);

		if (in_array($func, $requestMethodKeys)) {

			self::add($func, ...$params);
		} else {
			throw new Error("Method `$func` is not supported");
		}
	}

	private static function add(
		string $method,
		string $path,
		array $handler,
		array  $middlewares = []
	) {
		// set default handler method to index if not defined
		if (!isset($handler[1])) $handler[1] = "index";

		$method = self::$allowedMethods[$method];

		self::$routes[] = [
			"method" => $method,
			"path" => $path,
			"handler" => $handler,
			"middlewares" => $middlewares
		];
	}

	public function listen()
	{
		$path = "/";
		if (isset($_REQUEST["PATH_INFO"])) {
			$path = $_REQUEST["PATH_INFO"];
		}

		$requestedMethod = $_SERVER['REQUEST_METHOD'];

		foreach (self::$routes as $route) {
			$matchRoutePath = preg_match("#^" . $route["path"] . "$#", $path, $variables);
			$isValidMethod = $route["method"] === $requestedMethod;

			if ($matchRoutePath && $isValidMethod) {
				// call middlewares (before)
				foreach ($route["middlewares"] as $middleware) {
					$instance = new $middleware;
					$instance->before();
				}

				list($controller, $method) = $route["handler"];

				$controller = new $controller;

				array_shift($variables); // exclude path from $variables
				call_user_func_array([$controller, $method], $variables);

				return;
			}
		}

		http_response_code(404);
		echo "Not Found";
	}
}
