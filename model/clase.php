<?php
Class Object
{
    public function __construct($entidad,$key=null)
    {
        $this->oBB = new Conexion();
        if(!is_null($id))
        {
            $this->oBB->open();
            $result = $this->oBB->consult("SELECT * FROM {tabla} WHERE {AtributoPK}=".$id.";");
            $this->oBB->close();
            if(count($result)>0)
            {
                foreach ($result["0"] as $campo => $valor )
                {
                    $this->$campo = $valor;
                }
            }
        }
        else
        {
            $this->{AtributoPK} = null;
        }
    }

    private function consultDB($_sql)
    {

    }

    private function run($_sql)
    {

    }

    public function s_{AtributoPK}($id)
    {
        $this->{AtributoPK} = $id;
    }

        {seters}

        {geters}

    public function save()
{
    if($this->{AtributoPK}==null)
    {
        $this->oBB->open();
        $this->{AtributoPK} = $this->oBB->insert_id("INSERT INTO {tabla} ({INSERT_ATRIB}) VALUES ({INSERT_VALUES})");
        $this->oBB->close();
    }
    else
    {
        $this->oBB->open();
        $this->oBB->run("UPDATE {tabla} SET {UPDATE} WHERE {AtributoPK}=".$this->{AtributoPK}.";");
        $this->oBB->close();
    }
}

    public function delete()
{
    $this->oBB->open();
    $this->oBB->run("DELETE FROM {tabla} WHERE {AtributoPK}=".$this->{AtributoPK}.";");
    $this->oBB->close();
}

    public function show()
{
    return "
                    <div class='panel panel-default'>
                      <div class='panel-body'>
                        {AttribShow}
                      </div>
                    </div>
                    ";
}

    public function convertToJSON()
{
    $var = get_object_vars($this);
    unset($var['oBB']);
    return json_encode($var);
}

    public function setAttributesJSON($JSON)
{
    $Obj = json_decode($JSON);
    $result = "";
    foreach($Obj as $Attribute => $val)
    {
        if(property_exists($this,$Attribute))
        {
            $this->$Attribute = $val;
        }
    }
}

    public static function sync($opera)
{
    $param = explode("/", $opera);

    switch ($param[0]) {
        case 'get':
            $o = new {Tabla}($param[1]);
            echo $o->convertToJSON();
            break;

        case 'save':
            $o = new {Tabla}();
            $o->setAttributesJSON(file_get_contents("php://input"));
            $o->save();
            echo json_encode(array('status'=>'OK'));
            break;

        case 'delete':
            $o = new {Tabla}();
            $o->setAttributesJSON(file_get_contents("php://input"));
            $o->delete();
            echo json_encode(array('status'=>'OK'));
            break;

        default:
            echo json_encode(array('status'=>'NO'));
            break;
    }

}

    //---|||SimplePHP|||---//

}

// - Coleccion

Class Collection{Tabla}
{
    private $oBB;
    private $count;
    private $list;
    public ${tabla};

    public function __construct($condicion=null,$limit=null)
{
    $this->oBB = new Conexion();
    $this->{tabla} = array();

    if(is_null($condicion))
    {
        $where = "";
    }
    else
    {
        $where = " WHERE ".$condicion;
    }

    if(is_null($limit))
    {
        $limit = "";
    }
    else
    {
        $limit = " LIMIT ".$limit;
    }

    $this->oBB->open();
    $result = $this->oBB->consult("SELECT * FROM {tabla} ".$where." ".$limit.";");
    $this->oBB->close();
    $this->count = count($result);
    $this->list = $result;
    if(count($result)>0)
    {
        for($i=0;$i<count($result);$i++)
        {
            $ob = new {Tabla}(null);
            foreach ( $result[$i] as $campo => $valor )
            {
                $MCampo = 'set'.ucwords($campo);
                ($campo=='{AtributoPK}')?($ob->s_{AtributoPK}($valor)):($ob->$MCampo($valor));
            }
            array_push($this->{tabla},$ob);
        }

    }

}

    public function save()
{
    for($i=0;$i<$this->count;$i++)
    {
        $this->{tabla}[$i]->save();
    }
}

    public function count()
{
    return $this->count;
}

    public static function sync($opera)
{
    $param = explode("/", $opera);
    $filasXpagina = (isset($param[3]) && $param[3]!="")?$param[3]:500;
    $page = (isset($param[2]) && $param[2]!="")?$param[2]:1;

    $condicion = null;
    if(isset($param[1]) && $param[1]!="-" && $param[1]!="")
    {
        $condicion = str_replace("%20"," ",$param[1]);
        $condicion = str_replace("%25","%",$condicion);
        $condicion = str_replace("%22","'",$condicion);
    }

    $oBB = new Conexion();
    $oBB->open();
    $result = $oBB->consult("SELECT count(*) as cantidad FROM {tabla} ".$condicion.";");
    $oBB->close();
    $cantPaginas = ceil((int)$result[0]['cantidad']/$filasXpagina);

    $indiceInicio = ((($filasXpagina*$page))-$filasXpagina);
    $indiceInicio = ($indiceInicio<0)?0:$indiceInicio;

    switch ($param[0])
    {
        case 'get':

            $o = new Collection{Tabla}($condicion,$indiceInicio.",".$filasXpagina);
            if($o->count()>0)
            {
                $json = "[".$o->{tabla}[0]->convertToJSON();
                for($i=1;$i<$o->count();$i++)
                {
                    $json = $json.",".$o->{tabla}[$i]->convertToJSON();
                }
                $json = $json."]";

                echo $json;
            }
            else
            {
                echo "[]";
            }
            break;

        case 'countPages':

            echo json_encode(array('countPages'=>$cantPaginas));
            break;

        default:
            echo json_encode(array('status'=>'NO'));
            break;
    }


}

    /*public function list()
    {
        return FTN::toArray($this->list);
    }*/

}
?>