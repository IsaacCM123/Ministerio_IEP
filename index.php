<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="1_css.css">
</head>
<body>
    <h2>Registro</h2>
    <form method="POST" action="2_persona.php">
        <input type="text" id="N_C" placeholder="nombre..." name="N" autofocus autocomplete="off"><br><br>
        <button type="submit">Insertar</button>
    </form>

    <center><a href="pastores.php">Ir a Sitio Pastores</a></center>

    <table id="table">
        <thead>
            <th>Indice Persona</th>
        </thead>
        <tbody id="cuerpo">
            
        </tbody>
    </table>

     <!-- ====================== AQUÍ: cliente de Socket.IO ======== INICIO -->
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    <script>
        const socket = io("https://socket-production-95b7.up.railway.app"); // URL de tu servicio Node

        socket.on('nuevoRegistro', (data) => {
            getData(); // reutilizas tu misma función que ya llena la tabla
        });
    </script>
    <!-- ============================================================ FINAL -->

    <script>
        function obtenerDato(datoColumna)
        {
            let campoID         = document.getElementById('N_C')
            let datoObtenido    = datoColumna.innerHTML
            campoID.value       = datoObtenido
        }
    </script>

    <script>
        getData()
        document.getElementById('N_C').addEventListener('keyup', getData)
        function getData(){
            let camptext    = document.getElementById('N_C').value
            let cuerpoTBL   = document.getElementById('cuerpo')
            let url         = '4_lista.php'
            let formaData   = new FormData()
            formaData.append('N', camptext)
            fetch(url, {
                method: 'POST',
                body: formaData
            }).then(response => response.json())
            .then(data => {
                cuerpoTBL.innerHTML = data
            })
        }
    </script>
</body>
</html>