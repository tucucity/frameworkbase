// --------------------------------- Admin
function generarClase(nombreC)
{
    $.ajax({
        method: "POST",
        url: "admin/createClass/"+nombreC
    })
        .done(function( msg ) {
            resultado = JSON.parse(msg);
            $("#Resp_"+nombreC).html(resultado.status);
        });
}

function generarRelationClass()
{
    $.ajax({
        method: "POST",
        url: "admin/createRelation/"+$("#classLeft").val()+"/"+$("#classLeftAttrib").val()+"/"+$("#classRight").val()+"/"+$("#classRightAttrib").val()+"/"+$("#relation").val()
    })
        .done(function( msg ) {
            resultado = JSON.parse(msg);
            $("#respuestaRelacion").html(resultado.status);
        });
}

function attribs(idRespuesta,classe)
{
    $.ajax({
        method: "POST",
        url: "admin/getAttribClass/"+classe
    })
        .done(function( msg ) {
            resultado = JSON.parse(msg);
            $("#"+idRespuesta).html(resultado.options);
        });
}

function generarJSClass()
{
    $.ajax({
        method: "POST",
        url: "admin/generaJS/"+$("#JSClass").val()
    })
        .done(function( msg ) {
            resultado = JSON.parse(msg);
            $("#respuestaJS").html(resultado.status);
        });
}

function generarView()
{
    $.ajax({
        method: "POST",
        url: "admin/generaView/"+$("#viewClass").val()
    })
        .done(function( msg ) {
            resultado = JSON.parse(msg);
            $("#respuestaView").html(resultado.status);
        });
}

$("#classLeft").change(function()
{
    attribs("classLeftAttrib",$("#classLeft").val());
});
$("#classRight").change(function()
{
    attribs("classRightAttrib",$("#classRight").val());
});
attribs("classLeftAttrib",$("#classLeft").val());
attribs("classRightAttrib",$("#classRight").val());
// ------------------------------------------------