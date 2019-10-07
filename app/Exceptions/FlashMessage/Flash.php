<?php


namespace App\Exceptions\FlashMessage;


use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;


class Flash implements FlashInterface
{


    public static $data = [];
    protected static $withData = [];


    public function add(string $key,$value):self {
        session()->flash($key,$value);
        array_push(static::$data,$key);

        return $this;

    }

    public  static function set(string $key,$value){
        $self = new  self();
        $data = is_array($value)?collect($value):$value;
        return $self->add($key,$data);
    }
    public function has(string $key): bool
    {
        return session()->has($key)?true:false;
    }

    public function with(string $key,$value){
        array_push(static::$withData,[$key=>$value]);
        return $this;
    }
    public static function withFormErrors(ViewErrorBag $errors){

        $self = new  self();
        if ($errors->any()){
            array_push(static::$withData,['formErrors'=>collect($errors->all())]);

        }
        return $self;

    }

    public static function find($key){
        $self = new self();
        if ($self->has($key)){
            return session()->get($key);
        }else{
            return null;
        }
    }
    public function get($key=null):Collection{

        return collect(static::$data)
            ->filter(function($item,$key){
            return session()->has($item);})
            ->map(function ($item,$key){
                return [$item=>session()->get($item)];
            })->concat(static::$withData)
            ->collapse();

    }

    public static function all($key=null):Collection{
        return (new self())->get($key=null);
    }

    /**
     * @return array
     */
    public function keys():array{

        return [
            'error',
            'errors',
            'created',
            'success',
            'updated',
            'uploaded',
            'removed',
            'added',
            'warning',
            'info',
        ];
    }

    /**
     * @return array
     */
    public function keysWithValues():array{
        return [];
    }



    /**
     * @param array $messages
     * @return Flash
     */
    public static function	formErrors(array $messages):self {
        $self = new self();
        $self->add('formErrors',$messages);
        return $self;
    }

    /**
     * @param $message
     * @return Flash
     */
    public static function	error($message):self {
        $self = new self();
        $self->add('error',$message);

        return $self;

    }

    /**
     * @param $message
     * @return Flash
     */
    public static function	created($message):self {

        $self = new self();
        $self->add('created',$message);
        return $self;
    }

    /**
     * @param $message
     * @return Flash
     */
    public static function	success($message):self {
        $self = new self();
        $self->add('success',$message);
        return $self;

    }

    /**
     * @param $message
     * @return Flash
     */
    public static function	updated($message):self {
        $self = new self();
        $self->add('updated',$message);
        return $self;


    }

    /**
     * @param $message
     * @return Flash
     */
     public static function	uploaded($message):self {
         $self = new self();
         $self->add('uploaded',$message);
         return $self;

     }

    /**
     * @param $message
     * @return Flash
     */
     public static function	removed($message):self {
         $self = new self();
         $self->add('removed',$message);
         return $self;
     }

    /**
     * @param $message
     * @return Flash
     */
     public static function	added($message):self {
         $self = new self();
         $self->add('added',$message);
         return $self;

     }

    /**
     * @param $message
     * @return Flash
     */
    public static function warning($message):self {
        $self = new self();
        $self->add('warning',$message);
        return $self;
    }

    /**
     * @param $message
     * @return Flash
     */
    public static function info($message):self{
        $self = new self();
        $self->add('warning',$message);
        return $self;
    }

    public static function input(string $key,$message):self {
        $self = new self();
        $self->add('input.'.$key,$message);
        return $self;
    }





}