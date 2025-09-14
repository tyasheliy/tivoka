<?php

namespace Tivoka\Server;

use ReflectionClass;
use ReflectionMethod;

abstract class AbstractController
{
	protected string $methodPrefix;

	public function formatMethods(): array
	{
		$methods = [];
		$reflection = new ReflectionClass($this);

		foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
			$methodName = $method->getName();

			if ($methodName === "formatMethods") {
				continue;
			}

			$methods[$this->getMethodName($methodName)] = [$this, $methodName];
		}

		return $methods;
	}

	private function getMethodName(string $method): string 
	{
		return $this->methodPrefix === ""
			? $method
			: $this->methodPrefix . "." . strtoupper($method[0]) . substr($method, 1);
	}
}
