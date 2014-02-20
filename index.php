<script src="bootstrap/js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $("#agregar").click(function() {
            $.get('dameFila.php', null, function(informacion) {
                $("#tabla").append(informacion);
            });
        });
    });
</script>
<html>
    <br>
    <br>
    <table id="tabla">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Sexo</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr id="filaBase" class="fila-base">
                <!--<td><input type="text" class="nombre" value="hola como estas "/></td>-->
<!--                <td><input type="text" class="apellidos" /></td>
                <td>
                    <select class="sexo">
                        <option value="0">- Sexo -</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </td>
                <td class="eliminar">Eliminar</td>-->
            </tr>
            <tr>
                <td><input type="text" class="nombre" /></td>
                <td><input type="text" class="apellidos" /></td>
                <td>
                    <select class="sexo">
                        <option value="0">- Sexo -</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </td>
                <td class="eliminar">Eliminar</td>
            </tr>
        </tbody>
    </table>
    <!-- Botón para agregar filas -->
    <input type="button" id="agregar" value="Agregar fila" />
</html>