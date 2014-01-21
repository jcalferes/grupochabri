<?php
include './administracion.dao/dao.php';
include './administracion.clases/ListaPrecio.php';
$listaPrecio = new ListaPrecio();
$dao = new dao();
$consulta=$dao->consultarListaPrecios(); 

while ($rs = mysql_fetch_array($consulta)) {
   echo'<label><input type="radio" value='.$rs[1].' name="listaPrecios" class=""/>'.$rs[1].'</label> ';
           
}
//echo '<br/><input type="number" placeholder="Costo" class="form-control" /> <br/>
//           <input type="number" placeholder="Tarifa" class="form-control" /> <br/>
//           <input type="submit" value="atras" class="btn btn-primary" id="anterior" /></br>
//           <input type="submit" value="guardar" class="btn btn-primary" id="guardarDatos"/>
//           ';