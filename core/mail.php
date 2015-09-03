<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 02/09/2015
 * Time: 23:09
 */
class Mail {

    private $destino;
    private $origen;
    private $usuario;
    private $passw;
    private $ssl;
    private $smtp;
    private $asunto;
    private $texto;

    public function __construct(){}
    public function __destruct(){}

    public function enviar() {

        require_once('class.phpmailer.php');

        $mail = new PHPMailer(); // defaults to using php "mail()"

        //$body = file_get_contents('contenido.html');
        $body = $this->texto;

        $mail->SetFrom($this->origen, 'Nombre completo'); //email y nombre del remitente

        $mail->AddReplyTo($this->origen,"Nombre Completo"); //es bueno dejar la misma dirección que el From, para no caer en spam

        $mail->AddAddress($this->destino, "Nombre Destinatario");

        $mail->Subject = $this->asunto; //"Envío de email Prueba";

        $mail->AltBody = "Cuerpo alternativo del mensaje";

        $mail->MsgHTML($body);

        //$mail->AddAttachment("ruta/archivo_adjunto.gif");

        if(!$mail->Send()) {
            echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
        } else {
            echo "Mensaje enviado!!";
        }
    }
}