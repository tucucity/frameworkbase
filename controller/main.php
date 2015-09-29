<?php 
class Main{
	public static function init()
    {
        /*$o = new Mail();
        $o->host = "smtp.gmail.com";
        //$o->destino = "bautista.luis.88@gmail.com";
        $o->nomOrigen = "Javier Caniparoli";
        $o->origen = "jcaniparoli@cofaral.com.ar";
        $o->passw = "JCaniparoli1053";
        $o->secure = true;
        $o->ssl = "tls";
        $o->port = 587;
        $o->asunto = "Email Funcionando";
        $o->texto = "<html>
                        <body style='color: darkblue; font-style: italic'>
                            <span style='color: #ac2925'>Luis</span>, ya esta funcionando el envio de correo. Nose si viste que la base de datos tambien ya la modifiqué. En un rato subo las cosas al github.<br>
                            Avisame si te llega el correo.<br><br>
                            <span style='color: #449d44'>Saludos</span><br>
                            <span style='color: #449d44'>Cani</span>
                        </body>
                     </html>";

        if (!$o->enviar()) {
            echo $o->error;
        }
		//View::show("main");
        echo "<br>";*/

        $o = new Object("prueba",1);
        echo $o->getNombre." ".$o->getApellido;

        //View::show("main");
        //Imagen::getImg(IMG."logo.png",50,200);
    }
}

 ?>