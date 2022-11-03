<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        
    }

    public function enviarConfirmacion(){

        //Crear el objeto de email
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp.gmail.com';
        $email->SMTPAuth = true;
        $email->Port = 587;
        $email->Username = 'textilesotore@gmail.com';
        $email->Password = 'egrfsodvonwirjve';  //contrasenia porporcionala por la gestion de contrasenias de google para apps
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


        $email->setFrom('textilesotore@gmail.com', 'Gestion de Cuentas Textile Store'); //direccion proporcionada en mailtrap para practicas de desarrollo
        $email->addAddress($this->email, 'TextileStore.com');
        $email->Subject = 'Confirmar Cuenta';

        //Se utilizara ktml
        $email->isHTML(TRUE);
        $email->CharSet= 'UTF-8';

        // envio el token por peticion get a la pagina confirmar cuenta
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola" . $this->nombre."</strong> para confirmar la creacion de la cuenta en Kalen
        debe presionar el siguiente link</p>";
        $contenido.= "<p>Presiona el siguiente enlace</p>";
?>
        <form methos="POST" action="confirmar-cuenta">
        <input type="hidden" name="token" value="<?php echo($this->token);?>">
        <button type="submit">Confirmar</button>
<?php
     //   <!-- <a href='https://whispering-temple-36485.herokuapp.com/confirmar-cuenta?token=  
     //   ". $this->token ."'>Confirmar Cuenta</a> </p>"; -->


        $contenido.= "<p>SI no has solicitado la cuenta, ignora el mensaje</p>";
        $contenido.= "</html>";

        //Agrego el contenido construido al cuerpo 
        $email->Body= $contenido;

        //Enviar el email
        $email->send(); 

    }

    public function enviarInstrucciones(){

        //Crear el objeto de email
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp.gmail.com';
        $email->SMTPAuth = true;
        $email->Port = 587;
        $email->Username = 'textilesotore@gmail.com';
        $email->Password = 'egrfsodvonwirjve';  //contrasenia porporcionala por la gestion de contrasenias de google para apps
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;



        $email->setFrom('textilesotore@gmail.com', 'Gestion de Cuentas Textile Store'); //direccion proporcionada en mailtrap para practicas de desarrollo
        $email->addAddress($this->email, 'TextileStore.com');      
        $email->Subject = 'Restablecer Contrasena';

        //Se utilizara ktml
        $email->isHTML(TRUE);
        $email->CharSet= 'UTF-8';

        // envio el token por peticion get a la pagina confirmar cuenta
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola" . $this->nombre."</strong> para restablecer la contrasenia de la cuenta en Kalen
        debe presionar el siguiente link</p>";
        $contenido.= "<p>Presiona aqui <a href='https://whispering-temple-36485.herokuapp.com/missAcount?token=  
        ". $this->token ."'>Restablecer Password</a> </p>";
        $contenido.= "<p>SI no has solicitado la recuperacion de el password, ignora el mensaje</p>";
        $contenido.= "</html>";

        //Agrego el contenido construido al cuerpo 
        $email->Body= $contenido;

        //Enviar el email
        $email->send(); 

    }


}





