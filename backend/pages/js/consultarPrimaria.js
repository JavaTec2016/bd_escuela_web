function consultarPrimaria(tabla, primariaNombre, primriaValor, success = (result)=>{}, reject = (reason)=>{}){
    let urlPrimaria = "../controller/procesar_detalles.php" + `?tabla=${tabla}&${primariaNombre}=${primriaValor}`;
    console.log("consultando: " + urlPrimaria);
    fetchJSON(urlPrimaria, "GET", null, success, reject);
}