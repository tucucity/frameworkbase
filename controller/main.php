<?php 
class Main{
	public static function init()
    {
        $o = new Object("usuario");
        $o->empresa = 0;
        echo $o->empresa;
    }
}

 ?>