<?php
Class Object
{
    private $attrib;

    public function __construct($entidad, $id=null)
    {
        $cnx = new Conexion();
        $cnx->open();
        $att = $cnx->consult("DESCRIBE ".$entidad);

        if(!empty($att))
        {
            if($id!=null)
            {
                // - ---------------------- Busco el campo Auto Incremental
                $PK_AutoIncremental = "";
                foreach($att AS $index=>$value)
                {
                    if($att[$index]['Extra']=='auto_increment')
                    {
                        $PK_AutoIncremental = $att[$index]['Field'];
                    }
                }

                // - ---------------------- Traigo el campo que corresponde con el id ingresado por el programador
                $registro = $cnx->consult("SELECT * FROM ".$entidad." WHERE ".$PK_AutoIncremental."=".$id.";");

                // - ---------------------- Cargo los atributos de la clase
                foreach($att AS $index=>$value)
                {
                    $this->attrib[$att[$index]['Field']] = $registro[0][$att[$index]['Field']];
                }
            }
            else
            {
                foreach($att AS $index=>$value)
                {
                    $this->attrib[$att[$index]['Field']];
                }
            }
        }
        else
        {
            echo "La Entidad ".$entidad." No Existe...";
            $cnx->close();
            exit();
        }
        $cnx->close();
    }

    public function __set($name, $value)
    {
        $this->attrib[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attrib)) {
            return $this->attrib[$name];
        }
        $trace = debug_backtrace();
        trigger_error(
            'Propiedad indefinida mediante __get(): ' . $name .
            ' en ' . $trace[0]['file'] .
            ' en la línea ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }


}

?>