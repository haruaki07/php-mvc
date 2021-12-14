<?php

namespace Haruaki07\CompanyProfile\Controller;

class HomeController
{
	public function index()
	{
		echo '<a href="/about">about page</a>';
	}

	public function about()
	{
		echo 'about';
	}

	public function number(int $num)
	{
		echo "Number: $num";
	}
}
