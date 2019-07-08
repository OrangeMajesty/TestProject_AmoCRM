<?php

use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{
	public function testSwapSymbol()
	{
		$this->assertEquals(
			'123',
			Filter::swapSymbol('123')
		);

		$this->assertEquals(
			'Привет! Мир,',
			Filter::swapSymbol('Привет, Мир!')
		);

		$this->assertEquals(
			'&*$e9 0fjwe 9je w38 h',
			Filter::swapSymbol('$*&e9 0fjwe 9je w38 h')
		);
	}
}