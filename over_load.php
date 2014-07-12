<?php

class SomeClass
{
  private $value = array();

  public function __get($name)
  {
    echo "get: $name",PHP_EOL;
    if(!isset($this->values[$name])){
      throw new OutofBoundsException($name . "not found!");
    }
    return $this->values[$name];
  }

  public function __set($name,$value)
  {
    echo "set: $name setted to $value",PHP_EOL;
    $this->values[$name] = $value;
  }
  
  public function __isset($name)
  {
    echo "isset: $name",PHP_EOL;
    return isset($this->values[$name]);
  }

  public function __unset($name)
  {
    echo "unset: $name",PHP_EOL;
    unset($this->values[$name]);
  }

  public function __call($name,$args)
  {
    echo "call: $name",PHP_EOL;
    $method_name = '_' . $name;
    if(!is_callable(array($this,$method_name))){
      throw new BadMethodCallException(array($name,$method_name),$args);
    }

    return call_user_func_array(array($this,$method_name),$args);
  }

  public static function __callStatic($name,$args)
  {
    echo "callStatic: $name",PHP_EOL;

    $method_name = '_' . $name;
    if(!is_callable(array('self',$method_name))){
      throw new BadMethodCallException(array($name,$method_name),$args);
    }
  }
    private function _bar($value)
    {
      echo "bar called with arg '$value'",PHP_EOL;
    }

    private static function _staticBar($value)
    {
      echo "staticBar called with arg '$value'",PHP_EOL;
    }

  }
    


$obj = new SomeClass();
$obj->foo = 10;