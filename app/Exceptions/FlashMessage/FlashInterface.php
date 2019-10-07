<?php


namespace App\Exceptions\FlashMessage;


use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;

interface FlashInterface
{



    public function add(string $key,$value);
    /**
     * @param $key
     * @param $value
     * @return Flash
     */
    public function with(string $key,$value);



    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public  static function set(string $key,$value);

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key):bool;

    /**
     * @param ViewErrorBag $errors
     * @return mixed
     */
    public static function withFormErrors(ViewErrorBag $errors);


    /**
     * @param $key
     * @return mixed
     */
    public static function find($key);
/*
    /**
 * @param null $key
 * @return Collection
 */
    public function get($key=null):Collection;

    /**
     * @param null $key
     * @return Collection
     */
    public static function all($key=null):Collection;


    /**
     * @return array
     */
    public function keys():array;

    /**
     * @return array
     */
    public function keysWithValues():array;



    /**
     * @param array $messages
     * @return Flash
     */
    public static function	formErrors(array $messages):Flash;

    /**
     * @param $message
     * @return Flash
     */
    public static function	error($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
    public static function	created($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
    public static function	success($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
    public static function	updated($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
    public static function	uploaded($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
    public static function	removed($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
   public static function	added($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
   public static function	warning($message):Flash;

    /**
     * @param $message
     * @return Flash
     */
    public static function	info($message):Flash;

    /**
     * @param string $key
     * @param $message
     * @return Flash
     */
    public static function input(string $key,$message):Flash;

}