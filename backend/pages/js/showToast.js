/**
 * muestra un toast si existe
 * @param {string} id 
 */
function showToast(id) {
    console.log(id);
    
    if (document.getElementById(id)){
        
        new bootstrap.Toast(document.getElementById(id)).show();
    }else {
        alert("no hay toasts");
    }
}
/**
 * 
 * @param {string} id 
 * @param {string} text 
 */
function setText(id, text){
    let element = document.getElementById(id);
    if(!element) return;
    element.innerText = text;
}
function hide(id){
    let e = document.getElementById(id);
    if (e) e.hidden = true;
}