/* Covertir Mayusculas*/

function toUpperCaseField(e) {
    e.value = e.value.toUpperCase();
}

/** Mascaras de campos */
function n_dui_mask(e) {
    var maskOptions = {
        mask: "00000000-0"
    };
    var mask = IMask(e, maskOptions);
}

function n_nit_mask(e) {
    var maskOptions = {
        mask: "0000-000000-000-0"
    };
    var mask = IMask(e, maskOptions);
}

function local_tel_mask(e) {
    var maskOptions = {
        mask: "0000-0000"
    };
    var mask = IMask(e, maskOptions);
}

function n_placa_mask(e) {
    var maskOptions = {
    mask: /^[a-z]{1}[0-9a-f]{0,6}$/i
    };
    var mask = IMask(e, maskOptions);
}

function money_mask(e){
    
    var numberMask = IMask(e, {
        mask:'$num',
        blocks:{
            num:{
                // other options are optional with defaults below
        scale: 2,  // digits after point, 0 for integers
        signed: false,  // disallow negative
        thousandsSeparator: '',  // any single char
        padFractionalZeros: false,  // if true, then pads zeros at end to the length of scale
        normalizeZeros: true,  // appends or removes zeros at ends
        radix: '.',  // fractional delimiter
        mapToRadix: ['.'],  // symbols to process as radix
        max: 1000000
            }
        }
        
      });
    
}

/* Otras Funciones */

function fecha_final(from,time,to)
{   
    var str = document.getElementById(from).value;
    var str_aux = str.split("-");
    var anio = str_aux[0];
    var mes = str_aux[1];
    var dia = str_aux[2];
    fecha = new Date(mes+" "+dia+" "+anio);
    
    var tiempo;
    tiempo = document.getElementById(time).value;
    
    var tm = tiempo;
    console.log(tm);
    if(parseInt(tm)==10){
        tiempo = "9";
        console.log("wi");
    }
    if(parseInt(tm)==100){
        tiempo="99";
    }
    
    fecha.setDate(fecha.getDate()+parseInt(tiempo));
    //entrega.setDate(entrega.getDate());
    if(parseInt(tm)==10 || parseInt(tm)==100){
         dia = fecha.getDate();
    }else{
        dia = fecha.getDate()-1;
    }
   
    mes=(fecha.getMonth()+1);
    anio = fecha.getFullYear();
    if(dia < 10){
        dia = "0"+dia;
    }
    
    
    if(mes <10 ){
        mes = "0"+mes;
    }

    var fin = anio + "-" + mes + "-" + dia;
	document.getElementById(to).value = fin;
	//document.getElementById("fin").value = fin;
    
}

function total_renta(ip0,ip1,ip2){
    let dias = document.getElementById(ip0).value;
    let monto = document.getElementById(ip1).value;
    let total = document.getElementById(ip2);

    let aux;
    aux = dias * monto;
    aux = aux.toFixed(2)
    total.value = aux;
}

function allow_ncr(id_input,id_select,id_label){
    var select = document.getElementById(id_select).value;
    var input = document.getElementById(id_input);
    var label = document.getElementById(id_label);
    
    if(select === 'credito'){
        input.removeAttribute("hidden");
        label.removeAttribute("hidden");
    }else{
        label.setAttribute("hidden",true);
        input.setAttribute("hidden",true);
    }

    
}

function show_hidden_input(input, condision, campo){

    input.forEach(element => {
        let input = document.getElementById(element);
        let cam = document.getElementById(campo);

        if(cam.value === condision){
            input.removeAttribute("hidden");
            
        }else{
            input.setAttribute("hidden",true);
        }
    });
}