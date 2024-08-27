<?php
    require_once "main.php";

    /*== Almacenando datos ==*/
    $nombre = limpiar_cadena($_POST['nombre_equipo']);
    $pj = limpiar_cadena($_POST['partidos_jugados']);
    $pg = limpiar_cadena($_POST['partidos_ganados']);
    $pe = limpiar_cadena($_POST['partidos_empate']);
    $pd = limpiar_cadena($_POST['partidos_perdidos']);
    $gf = limpiar_cadena($_POST['goles_favor']);
    $gc = limpiar_cadena($_POST['goles_contra']);
    
    // Define e inicializa diferencia de goles y puntos del equipo
    $dg = $gf - $gc;
    $puntos = ($pg * 3) + $pe; 

    /*== Verificando campos obligatorios ==*/
    if ($nombre == "" || $pj == "" || $pg == "" || $pe == "" || $pd == "" || $gf == "" || $gc == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Verificando integridad de los datos ==*/
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if (verificar_datos("[0-9]{1,30}", $pj)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Verificando nombre ==*/
    $check_nombre = conexion();
    $check_nombre = $check_nombre->query("SELECT nombre_equipo FROM equipos WHERE nombre_equipo='$nombre'");
    if ($check_nombre->rowCount() > 0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_nombre = null;

    /*== Guardando datos ==*/
    $guardar_equipo = conexion();
    $guardar_equipo = $guardar_equipo->prepare("INSERT INTO equipos(nombre_equipo, partidos_jugados, partidos_ganados, partidos_empate, partidos_perdidos, goles_favor, goles_contra, diferencia_goles, puntos_equipo) VALUES(:nombre, :pj, :pg, :pe, :pd, :gf, :gc, :dg, :puntos)");

    $marcadores = [
        ":nombre" => $nombre,
        ":pj" => $pj,
        ":pg" => $pg,
        ":pe" => $pe,
        ":pd" => $pd,
        ":gf" => $gf,
        ":gc" => $gc,
        ":dg" => $dg,         
        ":puntos" => $puntos 
    ];

    $guardar_equipo->execute($marcadores);

    if ($guardar_equipo->rowCount() == 1) {
        echo '
            <div class="notification is-info is-light">
                <strong>¡EQUIPO REGISTRADO!</strong><br>
                El equipo se registró con éxito
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo registrar el equipo, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_equipo = null;
