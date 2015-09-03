<?php
Class Object
{
    private $attrib;

    public function __construct($entidad, $id=null)
    {
        $cnx = new Conexion();
        $cnx->open();
        $att = $cnx->consult("DESCRIBE ".$entidad);
        $cnx->close();

        if(!empty($att))
        {
            foreach($att AS $index=>$value)
            {
                $this->attrib[$att[$index]['Field']];
            }
        }
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