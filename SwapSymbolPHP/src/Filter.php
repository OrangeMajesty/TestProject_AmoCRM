<?php 

/**
 * Тестовый класс
 */
class Filter
{

	/**
	 * Метод принимает на строку и меняет порядок
	 * небуквенных и нечисловых сомволов на обратный.
	 * 
	 * @return string 	возвращает обработанную строку.
	 */
	public static function swapSymbol($str)
	{
		$re = '/[\'",.!@#$%^&*()_+=\-~№;:?\<>\/{}[\]|`]/m';

		preg_match_all($re, $str, $matches, PREG_OFFSET_CAPTURE, 0);

		for($i = 0; $i != count($matches[0]); $i++)
		{
			$str[$matches[0][$i][1]] = $matches[0][count($matches[0])-$i-1][0];
		}

		return $str;
	}
}