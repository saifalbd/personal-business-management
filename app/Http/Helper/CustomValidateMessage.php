<?php
namespace App\Http\Helper;



/**
 *use App\Http\Helper\CustomValidateMessage;
 */

abstract class CustomValidate {
abstract protected function message($message,$field=false,$optional=false);
abstract public function required($field=false,$optional=false);
abstract public function integer($field=false,$optional=false);
abstract public function numeric($field=false,$optional=false);
abstract public function string($field=false,$optional=false);
abstract public function unique($field=false,$optional=false);
abstract public function digits_between($field=false,$optional=false);
abstract public function max($field=false,$optional=false);
abstract public function min($field=false,$optional=false);
abstract public function date($field=false,$optional=false);
abstract public function in($field=false,$optional=false);

}

class CustomValidateMessage extends CustomValidate
{

protected function message($message,$field=false,$optional=false)
{
	if ($field && !$optional) {
			return $field.$message;
		}else if($optional){
			return $field.' '.$optional;
		}else{
		 return $message;
		}

}
	/**
	 * [required description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */

public function required($field=false,$optional=false)
	{
		$message = ' are required';
		return $this->message($message,$field,$optional);
		
	}

	/**
	 * [integer description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */

public function integer($field=false,$optional=false)
	{
		$message = ' are Not Integer';
		return $this->message($message,$field,$optional);
	}

public function numeric($field=false,$optional=false)
	{
		$message = ' are Not numeric';
		return $this->message($message,$field,$optional);
	}



/**
	 * [string description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */
	public function string($field=false,$optional=false)
	{
		$message = ' are Not String';
		return $this->message($message,$field,$optional);
	}
/**
	 * [unique description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */
	public function unique($field=false,$optional=false)
	{
		$message = ' alredy Available';
		return $this->message($message,$field,$optional);
	}
/**
	 * [digits_between description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */
	
	public function digits_between($field=false,$optional=false)
	{
		$message = ' latter length'; 
		return $this->message($message,$field,$optional);
	}
/**
	 * [max description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */
	
	public function max($field=false,$optional=false)
	{
		$message = ' maximum latter length'; 
		return $this->message($message,$field,$optional);
	}
/**
	 * [min description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */
	public function min($field=false,$optional=false)
	{
		$message = '  minimum latter length';
		return $this->message($message,$field,$optional);
	}
	/**
	 * [date description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */
	public function date($field=false,$optional=false)
	{
			$message = ' not valid Date';
		return $this->message($message,$field,$optional);
	}
	
	/**
	 * [in description]
	 * @param  boolean $field    [input Field name]
	 * @param  boolean $optional [if want custome message]
	 * @return [type]            [string]
	 */
	public function in($field=false,$optional=false)
	{
			$message = ' value must be';
		return $this->message($message,$field,$optional);
	}
}