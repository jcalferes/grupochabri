<?php

$interfaz = '<tr id="filaBase" class="fila-base">
    <td><input type="text" class="nombre" value="hola como estas "/></td>
    <td><input type="text" class="apellidos" /></td>
        <td>
          <select class="sexo">
            <option value="0">- Sexo -</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
          </select>
       </td>
        <td class="eliminar">Eliminar</td>
    </tr>';
echo $interfaz;
?>