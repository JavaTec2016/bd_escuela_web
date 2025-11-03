function consultar(url, body_form, success = (result)=>{}, reject = (reason)=>{}){
    fetchJSON(url, "GET", body_form, success, reject);
}