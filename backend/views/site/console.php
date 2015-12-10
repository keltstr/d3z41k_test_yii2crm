<?php

/*class Power
{
	private $x = 2;
	private $y = 9;

	public function pow3()
	{
		$res = 1;
		for($i = 0; $i < $this->y; $i++){
			$res *= $this->x;
		}
		return $res;	
	}

	public function pow4($x, $y)
	{
		return (!$y)? 1 : $x * self::pow4($x, $y-1);		
	}
}

$a = new Power;
//echo $a->pow3();
echo $a->pow4(2, 11);*/

class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait SayWorld {
    public function sayHello() {
        parent::sayHello();
        echo 'World!';
    }
    public function sayName(){
  		echo 'test';
    }
    
}

class MyHelloWorld extends Base {
    use SayWorld;
}

$o = new MyHelloWorld();
$o->sayHello();
$o->sayName();
?>