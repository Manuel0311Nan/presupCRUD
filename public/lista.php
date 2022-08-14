<?php
session_start();
// !isset($_SESSION["auth"]) || $_SESSION["auth"] == false ? header('Location: ./parts/login.php') : '';
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
require_once(dirname(__FILE__) . "/registro.php");
// require_once(dirname(__FILE__) . "/parts/loading.php");


$conexion = connectServer(SERVER, USER, PASS, DATABASE);

$query = "SELECT * FROM presupuestos ";
$valor = $conexion -> prepare($query);
$valor -> execute();
$total = $valor->rowCount() + 1;
?>

<style>
    *{
        font-family: 'Roboto', sans-serif;
    }
  .data{
    background-color:#8D99AE;
}
.boton{
  background-color: #2B2D42;
  color: #EDF2F4
}
.boton:hover{
    color: #EDF2F4;
}
.bg-table{
    background-color: #EDF2F4;
}

</style>

<body class="data">
<div class="rounded my-3">
    <h2 class="text-center fw-normal text-dark">Visualiza tus <span class="fw-bold">presupuestos</span></h2>
    <h5 class="text-center text-muted fw-light mb-2">Comience a operar con alguna de nuestras herramientas</h5>
</div>
    <main class="container bg-white rounded p-5">
        <div class="d-flex my-2 justify-content-end">
            <a href="./index.php" class="btn boton fw-bold  col-12 col-md-3 col-lg-2">GENERADOR</a>
        </div>
        <table class="table col-12">
            <thead>
            <tr class=" text-dark">
                    <th class=" text-center">Presupuesto</th>
                    <th class=" text-center">Titulo</th>
                    <th class=" text-center">Empresa</th>
                    <th class=" text-center">Precio</th>
                    <th class=" text-center">Fecha</th>
                    <th class=" text-center">Ver</th>
					<th class=" text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($p = $valor->fetch(PDO::FETCH_ASSOC))
                {?>
                <?php
                    $d = new DateTime($p["fecha_generacion"]);?>
                    <tr>
                        <td class="fw-bold  text-md-center wid"> <?php echo $p['num_presupuesto']; ?> </td>
                        <td class=" text-center wid"><?php echo $p['titulo']; ?></td>
                        <td class=" text-center wid"><?php echo $p['empresa']; ?></td>
                        <td class=" text-center wid"><?php echo $p['precio']; ?> €</td>
                        <td class=" text-center wid "><?php echo $p['fecha_generacion']; ?></td>
                        <td class=" text-center wid"><a name="pdf" class="text-danger pt-2 pdf" target="_blank"  href='./assets/pdf/ . str_replace("#", "", $num_presupuesto) . ".pdf"'><span class="material-icons"> visibility file_open</span></a></td>
                        <td class=" text-center wid"> <a class="text-danger pt-2"  href="../public/edit.php?id=<?php echo $p['id'];?>"> <span class="material-icons">edit</span></a>
                        <a name="delete" class="text-danger pt-2"   href="../public/delete.php?id=<?php echo $p['id'];?> "><span class="material-icons">delete</span></a></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>

<script>
$(document).ready(
    function() {
    $('table').DataTable({
            "language": {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "infoThousands": ",",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad",
                    "collection": "Colección",
                    "colvisRestore": "Restaurar visibilidad",
                    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                    "copySuccess": {
                        "1": "Copiada 1 fila al portapapeles",
                        "_": "Copiadas %d fila al portapapeles"
                    },
                    "copyTitle": "Copiar al portapapeles",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Mostrar todas las filas",
                        "_": "Mostrar %d filas"
                    },
                    "pdf": "PDF",
                    "print": "Imprimir"
                },
                "autoFill": {
                    "cancel": "Cancelar",
                    "fill": "Rellene todas las celdas con <i>%d<\/i>",
                    "fillHorizontal": "Rellenar celdas horizontalmente",
                    "fillVertical": "Rellenar celdas verticalmentemente"
                },
                "decimal": ",",
                "searchBuilder": {
                    "add": "Añadir condición",
                    "button": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "clearAll": "Borrar todo",
                    "condition": "Condición",
                    "conditions": {
                        "date": {
                            "after": "Despues",
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vacío",
                            "equals": "Igual a",
                            "notBetween": "No entre",
                            "notEmpty": "No Vacio",
                            "not": "Diferente de"
                        },
                        "number": {
                            "between": "Entre",
                            "empty": "Vacio",
                            "equals": "Igual a",
                            "gt": "Mayor a",
                            "gte": "Mayor o igual a",
                            "lt": "Menor que",
                            "lte": "Menor o igual que",
                            "notBetween": "No entre",
                            "notEmpty": "No vacío",
                            "not": "Diferente de"
                        },
                        "string": {
                            "contains": "Contiene",
                            "empty": "Vacío",
                            "endsWith": "Termina en",
                            "equals": "Igual a",
                            "notEmpty": "No Vacio",
                            "startsWith": "Empieza con",
                            "not": "Diferente de"
                        },
                        "array": {
                            "not": "Diferente de",
                            "equals": "Igual",
                            "empty": "Vacío",
                            "contains": "Contiene",
                            "notEmpty": "No Vacío",
                            "without": "Sin"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Eliminar regla de filtrado",
                    "leftTitle": "Criterios anulados",
                    "logicAnd": "Y",
                    "logicOr": "O",
                    "rightTitle": "Criterios de sangría",
                    "title": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "value": "Valor"
                },
                "searchPanes": {
                    "clearMessage": "Borrar todo",
                    "collapse": {
                        "0": "Paneles de búsqueda",
                        "_": "Paneles de búsqueda (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Sin paneles de búsqueda",
                    "loadMessage": "Cargando paneles de búsqueda",
                    "title": "Filtros Activos - %d"
                },
                "select": {
                    "cells": {
                        "1": "1 celda seleccionada",
                        "_": "%d celdas seleccionadas"
                    },
                    "columns": {
                        "1": "1 columna seleccionada",
                        "_": "%d columnas seleccionadas"
                    },
                    "rows": {
                        "1": "1 fila seleccionada",
                        "_": "%d filas seleccionadas"
                    }
                },
                "thousands": ".",
                "datetime": {
                    "previous": "Anterior",
                    "next": "Proximo",
                    "hours": "Horas",
                    "minutes": "Minutos",
                    "seconds": "Segundos",
                    "unknown": "-",
                    "amPm": [
                        "AM",
                        "PM"
                    ],
                    "months": {
                        "0": "Enero",
                        "1": "Febrero",
                        "10": "Noviembre",
                        "11": "Diciembre",
                        "2": "Marzo",
                        "3": "Abril",
                        "4": "Mayo",
                        "5": "Junio",
                        "6": "Julio",
                        "7": "Agosto",
                        "8": "Septiembre",
                        "9": "Octubre"
                    },
                    "weekdays": [
                        "Dom",
                        "Lun",
                        "Mar",
                        "Mie",
                        "Jue",
                        "Vie",
                        "Sab"
                    ]
                },

                "editor": {
                    "close": "Cerrar",
                    "create": {
                        "button": "Nuevo",
                        "title": "Crear Nuevo Registro",
                        "submit": "Crear"
                    },
                    "edit": {
                        "button": "Editar",
                        "title": "Editar Registro",
                        "submit": "Actualizar"
                    },
                    "remove": {
                        "button": "Eliminar",
                        "title": "Eliminar Registro",
                        "submit": "Eliminar",
                        "confirm": {
                            "_": "¿Está seguro que desea eliminar %d filas?",
                            "1": "¿Está seguro que desea eliminar 1 fila?"
                        }
                    },
                    "error": {
                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                    },
                    "multi": {
                        "title": "Múltiples Valores",
                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                        "restore": "Deshacer Cambios",
                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                    }
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
            },
            dom: 'Bflrtip',
            buttons: [{
                extend: 'excel',
                text: 'Exportar en Excel',
                className: 'btn btn-success fw-bold  col-12 col-md-3 col-lg-2',
                // exportOptions: {
                //     columns: [1,3,4,5,6,7,9,10,11,12,13,14,15,16,17,18,19,20]
                // }
            }],

            "DisplayLength": 10,
            responsive: true,
            "autoWidth": true,
            orderCellsTop: true,
            fixedHeader: true,
            // initComplete: function() {
            //     var api = this.api();

            //     // For each column
            //     api
            //         .columns()
            //         .eq(0)
            //         .each(function(colIdx) {
            //             if (colIdx < 5 && colIdx > 2) {

            //                 // Set the header cell to contain the input element
            //                 var cell = $('.filters th').eq(
            //                     $(api.column(colIdx).header()).index()
            //                 );
            //                 var title = $(cell).text();
            //                 $(cell).html('<input type="text" placeholder="' + title + '" />');

            //                 // On every keypress in this input
            //                 $(
            //                         'input',
            //                         $('.filters th').eq($(api.column(colIdx).header()).index())
            //                     )
            //                     .off('keyup change')
            //                     .on('keyup change', function(e) {
            //                         e.stopPropagation();

            //                         // Get the search value
            //                         $(this).attr('title', $(this).val());
            //                         var regexr = '({search})'; //$(this).parents('th').find('select').val();

            //                         var cursorPosition = this.selectionStart;
            //                         // Search the column for that value
            //                         api
            //                             .column(colIdx)
            //                             .search(
            //                                 this.value != '' ?
            //                                 regexr.replace('{search}', '(((' + this.value + ')))') :
            //                                 '',
            //                                 this.value != '',
            //                                 this.value == ''
            //                             )
            //                             .draw();

            //                         $(this)
            //                             .focus()[0]
            //                             .setSelectionRange(cursorPosition, cursorPosition);
            //                     });
            //             }
            //         });

            // },
    })});
    </script>