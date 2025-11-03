/**
 * 
 * @param {HTMLTableElement} tabla 
 * @param {any[]} datos 
 */
function crearHeader(tabla, datos=[]){
    let head = document.createElement("thead");
    let tr = document.createElement("tr");
    head.append(tr);
    datos.forEach(dato =>{
        let col = document.createElement("th");
        col.innerHTML = dato;
        tr.append(col);
    })
    tabla.append(head);
}
/**
 * crea el body de una tabla o lo resetea si ya existe
 * @param {HTMLTableElement} tabla 
 */
function crearBody(tabla){
    if (document.getElementById(tabla.id + "-body") != null)
        document.getElementById(tabla.id + "-body").innerHTML = "";
    else {
        let body = document.createElement("tbody");
        body.setAttribute("id", tabla.id + "-body");
        tabla.append(body);
    }
    
}

/**
 * 
 * @param {HTMLTableElement} tabla 
 * @param {any{}} datos 
 */
function agregarRow(tabla, datos={}, id=null){
    let body = document.getElementById(tabla.id+"-body");
    
    for(const key in datos){
        let row = document.createElement("tr");
        if (id) row.setAttribute(body.id + "-" + id);

        let dato = datos[key];
        let col = document.createElement("th");
        let val = document.createElement("td");
        col.innerHTML = key;
        val.innerHTML = dato;

        row.append(col);
        row.append(val);
        
        body.append(row);
    }
    
}
function agregarRowCompleta(tabla, datos={}, id=null, campos=[]){
    let body = document.getElementById(tabla.id + "-body");
    let row = document.createElement("tr");
    if (id) row.setAttribute("id",body.id + "-" + id);
    for(const key in datos){
        if (campos.indexOf(key) == -1) continue;

        let dato = datos[key];
        let celda = document.createElement("td");
        celda.innerHTML = dato;
        row.append(celda);
    }
    body.append(row);
}
function agregarRowsCompletas(tabla, datos=[{}], idKey=null, campos=[]){
    let id = null;
    datos.forEach(registro=>{
        if(idKey) id = registro[idKey];
        agregarRowCompleta(tabla, registro, id, campos);
    })
}
/**
 * 
 * @param {HTMLTableElement} tabla 
 * @param {any[{}]} datos 
 */
function agregarRows(tabla, datos=[{}], ids=[]){
    datos.forEach((fila, idx)=> {
        let id = null;
        if(ids == null) id = idx;
        else if(ids.length > idx) id = ids[idx];
        agregarRow(tabla, fila, id);
    })
}
/**
 * 
 * @param {HTMLTableElement} tabla 
 * @param {any[{}]} datos 
 * @param {number} [idNombre=null] indice del valor que se usara como ID para el row
 */
function agregarRowsIndice(tabla, datos = [{}], idNombre = null) {
    console.log("agregando " + datos.length);
    
    datos.forEach((fila) => {
        let id = fila[idNombre];
        log(id);
        agregarRow(tabla, fila, id);
    })
}
/**
 * 
 * @param {HTMLTableElement} tabla 
 * @param {*} id 
 */
function removerRow(tabla, id){
    let body = document.getElementById(tabla.id+"-body");
    body.removeChild(document.getElementById(id))
}
/**
 * 
 * @param {HTMLTableElement} tabla 
 * @param {*} idSimple
 */
function removerRowSimple(tabla, idSimple) {
    let body = document.getElementById(tabla.id + "-body");
    body.removeChild(document.getElementById(body.id+"-"+idSimple))
}
/**
 * setea el html del body de una tabla
 * @param {HTMLTableElement} tabla 
 * @param {*} html
 */
function setBodyHTML(tabla, html){
    let body = document.getElementById(tabla.id+"-body");
    body.innerHTML = html;
}