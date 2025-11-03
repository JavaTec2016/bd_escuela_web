/**
 * 
 * @param {string} idModal 
 * @param {HTMLFormElement} form 
 */
function setForm(idModal, form){
    let body = document.getElementById(idModal + "-body");
    body.removeChild(document.getElementById(idModal+"-form"));

    if(!form.id) form.setAttribute("id", idModal+"-body");
    body.append(form);
}

function makeField(id = null, qlass = "mb-3"){
    let field = document.createElement("div");
    if(qlass) field.setAttribute("class", qlass);
    if(id) field.setAttribute("id", id);
    return field;
}
function makeInput(id, type, name, qlass = "form-control"){
    let input = null;
    if(type == "select"){
        //logica espesial
        return input;
    }
    input = document.createElement("input");
    input.setAttribute("type", type);
    input.setAttribute("id", id);
    if(name) input.setAttribute("name", name);
    if(qlass) input.setAttribute("class", qlass);
    return input;
}
function makeLabel(phor = null, txt = "", qlass = "form-label"){
    let label =  document.createElement("label");
    if(phor) label.setAttribute("for", phor);
    if(qlass) label.setAttribute("class", qlass);
    if(txt) label.innerHTML = txt;
    return label;
}

//============ si

function buildFieldGenerico(fieldId="", inputId=fieldId+"_input", inputType="", inputName=inputId, labelTxt=""){
    let div = makeField(fieldId);
    let label = makeLabel(inputId, labelTxt);
    let input = makeInput(inputId, inputType, inputName);

    div.append(label, input);
    return div;
}

function buildField(fieldId = "", inputId = fieldId + "_input", inputType = "", inputName = inputId, labelTxt = "", attribs={}){
    let field = buildFieldGenerico(fieldId, inputId, inputType, inputName, labelTxt);
    let input = field.children[1];
    for(const attribName in attribs){
        input.setAttribute(attribName, attribs[attribName]);
    }
    return field;
}
