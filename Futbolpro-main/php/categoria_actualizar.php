<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['id_equipo']);


    /*== Verificando categoria ==*/
	$check_equipo=conexion();
	$check_equipo=$check_equipo->query("SELECT * FROM equipos WHERE id_equipo='$id'");

    if($check_equipo->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El equipo no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_equipo->fetch();
    }
    $check_equipo=null;

    /*== Almacenando datos ==*/
    $nombre=limpiar_cadena($_POST['nombre_equipo']);
    /* $ubicacion=limpiar_cadena($_POST['categoria_ubicacion']); */


    /*== Verificando campos obligatorios ==*/
    if($nombre==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* if($ubicacion!=""){
    	if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}",$ubicacion)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La UBICACION no coincide con el formato solicitado
	            </div>
	        ';
	        exit();
	    }
    } */


    /*== Verificando nombre ==*/
    if($nombre!=$datos['nombre_equipo']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT nombre_equipo FROM equipos WHERE nombre_equipo='$nombre'");
	    if($check_nombre->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_nombre=null;
    }


    /*== Actualizar datos ==*/
    $actualizar_equipo=conexion();
    $actualizar_equipo=$actualizar_equipo->prepare("UPDATE equipos SET nombre_equipo=:nombre,partidos_jugados=:pj,partidos_ganados=:pg,partidos_empate=:pe,partidos_perdidos=:pd,goles_favor=:gf,goles_contra=:dg,puntos_equipo=:puntos WHERE id_equipo=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":pj"=>$pj,
        ":pg"=>$pg,
        ":pe"=>$pe,
        ":pd"=>$pd,
        ":gf"=>$gf,
        ":gc"=>$gc,
        ":dg"=>$dg,
        ":puntos"=>$puntos,
        ":id"=>$id
    ];

    if($actualizar_equipo->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡CATEGORIA ACTUALIZADA!</strong><br>
                El equipo se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el equipo, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_equipo=null;