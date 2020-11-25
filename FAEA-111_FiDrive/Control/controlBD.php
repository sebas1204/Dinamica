<?php


include_once("../Modelo/BaseDatos.php");
include_once("../Modelo/estadotipos.php");
include_once("../Modelo/archivocargado.php");
include_once("../Modelo/archivocargadoestado.php");
include_once("../Modelo/usuario.php");

/* PRUEBAS;

$var = estadotipos::eT_construct(0,0,"Testing");
$var->insertDB();

echo "Nuevo estado 'estadotipos' ID: {$var->getIdEstado()}\n";

$var2 = archivocargadoestado::aRE_construct(null,1,"Default shit",1,1);

$var2->insertDB();

echo "Nuevo estado 'archivocargadoestado' ID: {$var2->getIdarchivocargadoestado()}\n"; 

print_r(estadotipos::listarDB()); */

 
/* $archivis = archivocargadoestado::buscarDB('idarchivocargadoestado',6);

$i1 = $archivis->getIdestadotipos()->getIdEstado();
$i2 = $archivis->getUsuario()->getIduser();
$i3 = $archivis->getIdarchivocargado()->getIDarchcargado();
echo "<p>ID ARE: {$archivis->getIdarchivocargadoestado()}</p>
<p>ID ET: {$i1}</p>
<p>ID USER: {$i2}</p>
<p>DESCRIPCION: {$archivis->getAcedescripcion()}</p>
<p>ID AC: {$i3}</p>
<p>FECHA INGRESO: {$archivis->getAcefechaingreso()}</p>
<p>FECHA FINAL: {$archivis->getAcefechafin()}</p>
      ";

$fecha = (new DateTime())->format('Y-m-d H:i:s');
$param = array("idestadotipos"=>2,"acefechafin"=>"'{$fecha}'");
echo "<p>Cantidad de filas afectadas: {$archivis->actualizardDB($param)}</p>";

$archivis = archivocargadoestado::buscarDB('idarchivocargadoestado',6);
$i1 = $archivis->getIdestadotipos()->getIdEstado();
$i2 = $archivis->getUsuario()->getIduser();
$i3 = $archivis->getIdarchivocargado()->getIDarchcargado();
echo "<p>ID ARE: {$archivis->getIdarchivocargadoestado()}</p>
<p>ID ET: {$i1}</p>
<p>ID USER: {$i2}</p>
<p>DESCRIPCION: {$archivis->getAcedescripcion()}</p>
<p>ID AC: {$i3}</p>
<p>FECHA INGRESO: {$archivis->getAcefechaingreso()}</p>
<p>FECHA FINAL: {$archivis->getAcefechafin()}</p>
      "; */


class controlDB{

    public static function userselector(){
        $block="";
        $listado = usuario::listarDB(); 
        foreach ($listado as $user){
            $valor = $user->getIduser();
            $tag = $user->getUname();
            $block .= "<option value='{$valor}'>{$tag}</option>";
        }
        return $block;
    }

    public static function muestraCargados (){
        $frame = "";
        $listado = archivocargado::listarDB();
        foreach ($listado as $archivo){
            $nombre = $archivo->getACnombre();
            $frame .= "<button class='btn btn-outline-secondary'>{$nombre}</button>
            <button class='btn btn-outline-secondary' type='submit' formmethod='post' formaction='amarchivo.php'>Modificar</button>
        <button class='btn btn-outline-secondary' type='submit' formmethod='post' formaction='compartirarchivo.php'>Compartir</a></button>
        <button class='btn btn-outline-secondary' type='submit' formmethod='post' formaction='eliminararchivocompartido.php'>Dejar de compartir</a></button>
        <button class='btn btn-outline-secondary' type='submit' formmethod='post' formaction='eliminararchivo.php?'>Eliminar</a></button>";
        }
        return $frame;
    }

    public static function cargarObjeto($param){
        $obj = Null;
        switch ($param['operation']) {
            case 0:
                $obj = usuario::U_construct($param);
                $obj->insertDB();
                echo "Se realizo una insercion exitosa.";
                break;
            case 1:
                $obj = archivocargado::AC_construct($param);
                $obj->insertDB();
                echo "Se realizo una insercion exitosa.";
                break;
            case 2:
                $obj = estadotipos::eT_construct($param);
                $obj->insertDB();
                echo "Se realizo una insercion exitosa.";
                break;
            case 3:
                $obj = archivocargadoestado::aRE_construct($param);
                $obj->insertarDB();
                echo "Se realizo una insercion exitosa.";
                break;
        }
        return $obj;
    } 

}
?>
