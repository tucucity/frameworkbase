<?php 
class Main{
	public static function init()
    {
        $o = new Mail("jcaniparoli@cofaral.com.ar","lbautista@cofaral.com.ar","Prueba","Este es el asunto de prueba!!!!!");
        $o->enviar();
		//View::show("main");
    }
}

 ?>