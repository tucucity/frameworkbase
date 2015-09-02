<?php	
class Admin{
	public static function init()
    {
            $oBB = new Conexion();
            $oBB->open();
            $tablas = $oBB->consult("SHOW TABLES");
            $lista = "";
            $ListRelation = "";
            $atributosEntidades = "";
            for($i=0;$i<count($tablas);$i++)
            {
                $lista = $lista."<li><span class='glyphicon glyphicon-ok' style='color:#3e8f3e'></span><label style='font-weight:normal'>&nbsp;".$tablas[$i]["Tables_in_".DB_NAME]."</label></li>";
                $ListRelation .= "<option value='".$tablas[$i]["Tables_in_".DB_NAME]."'>".$tablas[$i]["Tables_in_".DB_NAME]."</option>";
                $atrib = $oBB->consult("DESCRIBE ".$tablas[$i]["Tables_in_".DB_NAME]);
                $listaAtributos = "";
                for($j=0;$j<count($atrib);$j++)
                {
                    $key="";
                    $autoI = "";
                    ($atrib[$j]['Key']=="PRI")?($key="<b style='color: yellowgreen'>(K)</b>"):$key="";
                    ($atrib[$j]['Extra']=="auto_increment")?($autoI="<b style='color: sandybrown'>(A)</b>"):$autoI="";
                    $listaAtributos = $listaAtributos."<li>".$atrib[$j]['Field'].$key.$autoI."</li>";
                }
                $atributosEntidades = $atributosEntidades.
                    "<div class='col-xs-3' style='height:350px; padding:15px;'>
                        <div class='panel panel-info'>
                            <div class='panel-heading'>".$tablas[$i]["Tables_in_".DB_NAME]."</div>
                                    <div class='panel-body' style='height:220px; overflow-y: auto;'>

                                            <ul>
                                                ".$listaAtributos."
                                            </ul>
                                    </div>
                                    <button type='button' class='btn btn-success' style='width:100%;' onclick=\"generarClase('".$tablas[$i]["Tables_in_".DB_NAME]."');\">Generar</button>
                                    <div id='Resp_".$tablas[$i]["Tables_in_".DB_NAME]."' style='width:100%; text-align:center; color: darkcyan'></div>
                                </div>
                            </div>";

            }

            $data = array("Entidades"=>$lista,"classForRelation"=>$ListRelation,"atribEntidades"=>$atributosEntidades);
            View::show("admin",$data);

	}

	public static function createClass($tableName){
		SAdmin::createClass($tableName);
        echo json_encode(array("status"=>"Class ".$tableName."  Creada"));
	}
    public static function createRelation($param)
    {
        $parametro = explode("/", $param);
        $clase=$parametro[0];
        $clase_id=$parametro[1];
        $claseRelacion=$parametro[2];
        $claseRelacion_id=$parametro[3];
        $tipoRelacion=$parametro[4];

        SAdmin::createRelation($clase,$clase_id,$claseRelacion,$claseRelacion_id,$tipoRelacion);
        echo json_encode(array("status"=>"<span class='glyphicon glyphicon-ok' style='color:#3e8f3e'></span> (1)".$clase.".".$clase_id." = ".$claseRelacion.".".$claseRelacion_id."(".$tipoRelacion.")" ));
    }

    public static function getAttribClass($class)
    {
        echo SAdmin::getAttribClass($class);
    }

    public static function generaJS($tableName)
    {
        SAdmin::createJS($tableName);
        echo json_encode(array("status"=>"<span class='glyphicon glyphicon-ok' style='color:#3e8f3e'></span> SJS ".$tableName." generado"));
    }

    public static function generaView($tableName)
    {
        SAdmin::createView($tableName);
        echo json_encode(array("status"=>"<span class='glyphicon glyphicon-ok' style='color:#3e8f3e'></span> View ".$tableName." generada"));
    }

}
?>