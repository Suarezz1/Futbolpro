<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$conexion = conexion();

if (isset($busqueda) && $busqueda != "") {
    $consulta_datos = "SELECT *, 
                        (partidos_ganados * 3) + (partidos_empate * 1) AS puntos_equipo,
                        (goles_favor - goles_contra) AS diferencia_goles
                       FROM equipos 
                       WHERE nombre_equipo LIKE '%$busqueda%' 
                       ORDER BY puntos_equipo DESC, diferencia_goles DESC, goles_favor DESC, goles_contra ASC 
                       LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(id_equipo) FROM equipos WHERE nombre_equipo LIKE '%$busqueda%'";
} else {
    $consulta_datos = "SELECT *, 
                        (partidos_ganados * 3) + (partidos_empate * 1) AS puntos_equipo,
                        (goles_favor - goles_contra) AS diferencia_goles
                       FROM equipos 
                       ORDER BY puntos_equipo DESC, diferencia_goles DESC, goles_favor DESC, goles_contra ASC 
                       LIMIT $inicio, $registros";

    $consulta_total = "SELECT COUNT(id_equipo) FROM equipos";
}

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

$Npaginas = ceil($total / $registros);

$tabla .= '
<div class="table-container">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
    <thead>
        <tr class="has-text-centered">
            <th>#</th>
            <th>Equipo</th>
            <th>PJ</th>
            <th>PG</th>
            <th>PE</th>
            <th>PD</th>
            <th>GF</th>
            <th>GC</th>
            <th>DG</th>
            <th>Puntos</th>
            <th colspan="2">Opciones</th>
        </tr>
    </thead>
    <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        // Calcular partidos perdidos
        $partidos_perdidos = $rows['partidos_jugados'] - ($rows['partidos_ganados'] + $rows['partidos_empate']);
        
        $tabla .= '
        <tr class="has-text-centered">
            <td>' . $contador . '</td>
            <td>' . $rows['nombre_equipo'] . '</td>
            <td>' . $rows['partidos_jugados'] . '</td>
            <td>' . $rows['partidos_ganados'] . '</td>
            <td>' . $rows['partidos_empate'] . '</td>
            <td>' . $partidos_perdidos . '</td>
            <td>' . $rows['goles_favor'] . '</td>
            <td>' . $rows['goles_contra'] . '</td>
            <td>' . $rows['diferencia_goles'] . '</td>
            <td>' . $rows['puntos_equipo'] . '</td>
            <td>
                <a href="index.php?vista=category_update&category_id_up=' . $rows['id_equipo'] . '" class="button is-success is-rounded is-small">Actualizar</a>
            </td>
            <td>
                <a href="' . $url . $pagina . '&category_id_del=' . $rows['id_equipo'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
            </td>
        </tr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    $tabla .= '
    <tr class="has-text-centered">
        <td colspan="12">
            ' . ($total >= 1 ? '<a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">Haga clic acá para recargar el listado</a>' : 'No hay registros en el sistema') . '
        </td>
    </tr>
    ';
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando equipos <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion = null;
echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
?>
