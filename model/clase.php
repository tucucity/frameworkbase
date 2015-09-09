<?php
Class Object
{
    private $attrib;
    private $type;
    private $PK;
    private $ID = null;

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
                foreach($att AS $index=>$value)
                {
                    if($att[$index]['Extra']=='auto_increment')
                    {
                        $this->PK = $att[$index]['Field'];
                        $this->type[$att[$index]['Field']] = $att[$index]['Type'];
                    }
                    else
                    {
                        $this->type[$att[$index]['Field']] = $att[$index]['Type'];
                    }
                }
                // - ---------------------- Traigo el campo que corresponde con el id ingresado por el programador
                $registro = $cnx->consult("SELECT * FROM ".$entidad." WHERE ".$this->PK."=".$id.";");

                // - ---------------------- Cargo los atributos de la clase
                if(count($registro)>0)
                {
                    foreach($att AS $index=>$value)
                    {
                        $this->attrib[$att[$index]['Field']] = $registro[0][$att[$index]['Field']];
                    }
                    $this->ID = $id;
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