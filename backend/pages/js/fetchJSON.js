
/**
 * convierte un formulario a string URL
 * @param {HTMLFormElement} form 
 */
function URLForm(form) {
    if(form == null) return "";
    return (new URLSearchParams(new FormData(form))).toString();
}

/**
 * fetchea un php y retorna el json
 * si se usa GET con un formulario, se agrega el formulario como parte de la URL del fetch, la url deberia estar ya preparada para concatenarlo.
 * Si se usa POST con un formulario, se agrega el FormData del formulario como el body del fetch
 * @param {string} URLRelativa la url del php (puede tener parametros GET)
 * @param {string} method GET o POST
 * @param {HTMLFormElement} form formulario (opcional)
 * @param {(json:{})=>{}} callbackSuccess funcion para manejar la respuesta
 * @param {(reason:string)=>{}} callbackReject funcion pa manejar el mensaje de error
 */
function fetchJSON(URLRelativa, method, form,
    
    callbackSuccess=(json)=>{console.log(json)},
    callbackReject=(reason)=>{console.log(reason)}
    
){
    
    let url = URLRelativa;
    if(method == 'GET'){
        url += URLForm(form);
    }
    fetch(url, {
        method: method,
        body: (form == null || method == 'GET') ? null : ( form instanceof HTMLFormElement ? new FormData(form) : form)
    })
        .then(response => {
            //response.text().then(text => console.log(text));
            return response.json()
        })
        .then(json => {
            console.log(json);
            callbackSuccess(json);
        })
        .catch((reason)=>{
            callbackReject(reason)
        })
}