<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Manuel
 * Date: 05-08-2011
 * Time: 12:26
 * To change this template use File | Settings | File Templates.
 */

class Model_Options{

	public function get($option_name)
	{
		$result = DB::select("*")->from("options")->where("option_name", $option_name)->execute();
		if(!count($result)) return false;
		return $result[0]["option_value"];
	}
}
