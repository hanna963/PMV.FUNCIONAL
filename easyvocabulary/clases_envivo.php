<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
include 'conexion.php'; 

// 1. Obtener el ID del usuario de la sesión
// Nota: Asegúrate de que en login.php guardes $_SESSION['usuario_id']
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0;
$eventos_js = "";

// 2. Consultar las citas guardadas para este usuario
$sql = "SELECT fecha, hora FROM citas WHERE usuario_id = '$usuario_id'";
$res = mysqli_query($conexion, $sql);

if ($res) {
    while($row = mysqli_fetch_assoc($res)){
        $h = $row['hora'];
        $f = $row['fecha'];
        // Preparamos los eventos para FullCalendar
        $eventos_js .= "{ title: 'Clase: $h', start: '$f', color: '#764ba2' },";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Clase en Vivo</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <style>
        body { background: #5dc1b9; font-family: sans-serif; text-align: center; padding: 20px; }
        .container-calendario {
            background: white;
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 700px;
            margin: 20px auto;
        }
        #calendar { min-height: 700px; }
        .btn-volver { color: #764ba2; font-weight: bold; text-decoration: none; display: inline-block; margin-top: 20px; }
        /* Estilos del Modal */
        #modalAgendar { display: none; position: fixed; z-index: 500; left: 0; top: 0; width: 50%; height: 50%; background-color: rgba(0,0,0,0.5); }
        .modal-content { background-color: white; margin: 10% auto; padding: 30px; border-radius: 20px; width: 300px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
        .btn-confirmar { background: #764ba2; color: white; border: none; padding: 10px 15px; border-radius: 10px; cursor: pointer; }
        .btn-cancelar { background: #ccc; border: none; padding: 10px 15px; border-radius: 10px; cursor: pointer; }
    </style>
</head>
<body>

    <div style="margin-top: 20px;">
        <h1 style="color: #032a52; margin-bottom: 5px;">📅 Agendar mi Clase en Vivo</h1>
        <p style="color: #666; margin-top: 0;">Selecciona un día para tu tutoría personalizada</p>
    </div>

    <div class="container-calendario">
        <div id="calendar"></div>
    </div>

    <a href="inicio.php" class="btn-volver">🏠 Volver al inicio</a>

    <div id="modalAgendar">
        <div class="modal-content">
            <h3 style="color: #032a52;">Confirmar Cita</h3>
            <p id="fechaSeleccionada" style="font-weight: bold; color: #555;"></p>
            <label>Selecciona la hora:</label><br>
            <input type="time" id="horaCita" style="padding: 8px; border-radius: 10px; border: 1px solid #ccc; margin: 15px 0; width: 80%;">
            <div style="display: flex; justify-content: space-around; margin-top: 20px;">
                <button onclick="cerrarModal()" class="btn-cancelar">Cancelar</button>
                <button onclick="guardarCita()" class="btn-confirmar">Agendar</button>
            </div>
        </div>
    </div>

    <script>
      let fechaGlobal;

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'es',
          selectable: true,
          // Cargamos los eventos que procesó PHP arriba
          events: [ <?php echo $eventos_js; ?> ],
          dateClick: function(info) {
            fechaGlobal = info.dateStr;
            document.getElementById('fechaSeleccionada').innerText = "Día: " + fechaGlobal;
            document.getElementById('modalAgendar').style.display = "block";
          }
        });
        calendar.render();
      });

      function cerrarModal() {
        document.getElementById('modalAgendar').style.display = "none";
      }

      function guardarCita() {
        let hora = document.getElementById('horaCita').value;
        if (hora === "") {
            alert("Por favor elige una hora");
            return;
        }

        let datos = new FormData();
        datos.append('fecha', fechaGlobal);
        datos.append('hora', hora);

        fetch('guardar_cita.php', {
            method: 'POST',
            body: datos
        })
        .then(res => res.text())
        .then(data => {
            if(data.trim() === "success") {
                alert("¡Cita guardada con éxito!");
                location.reload(); // Recarga para mostrar el nuevo evento púrpura
            } else {
                alert("Error al guardar: " + data);
            }
        });
      }
    </script>
</body>
</html>