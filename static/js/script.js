//------------------------------------------------------------------
//--------------------MODAL FORMULARIO LOGIN------------------------
//------------------------------------------------------------------
function validarFormulario() {
    var validacion = true;
    var email = document.getElementById("email_gestor");
    valorEmail = email.value;
    campo = document.getElementById('contra_gestor');
    valor = campo.value;

    if (valorEmail == null || valorEmail.length == 0 || /^\s+$/.test(valorEmail)) {
        alert('Debes de introducir el campo del email');
        validacion = false;

    } else if (!(/\S+@\S+.\S+/.test(valorEmail))) {
        alert('Formato de email incorrecto, un formato correcto seria email@email.com');
        validacion = false;

    } else if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        alert("Debes de introducir el campo de contraseña");
        validacion = false;

    } else if (valor.length < 8) {
        alert("La contraseña ha de ser mínimo de 8 caractéres");
        validacion = false;
    }

    if (!validacion) {
        return false;
    }
}
//------------------------------------------------------------------
//--------------------MODAL DARKMODE--------------------------------
//------------------------------------------------------------------
function darkMode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
}
//------------------------------------------------------------------
//--------------------MODAL PANTALLA DE CARGA-----------------------
//------------------------------------------------------------------
function loading() {
    var form = document.getElementById("form");
    var loading = document.getElementById("loading");

    if (form.style.display != "none") {
        form.style.display = "none";
        loading.style.display = "block";
    } else {
        form.style.display = "block";
    }
}

//------------------------------------------------------------------
//-------------MODAL ENVIAR MAIL Y PANTALLA DE CARGA----------------
//------------------------------------------------------------------
// OCULTAR EL INPUT EMAIL SI HAY ALGÚN GRUPO SELECIONADO
function selectedGroup() {
    var valorInputs = document.getElementById("grupoEmail").value;
    var error_correo = document.getElementById("error_correo");
    var cerrar2 = document.getElementById("cerrar2");
    if (valorInputs != "none") {
        document.getElementById("email").style.display = "none";
        error_correo.style.display = "none";
        cerrar2.style.top = "-210px";
    } else {
        document.getElementById("email").style.display = "block";
    }
}

function validarcorreoyloading() {


    var cerrar2 = document.getElementById("cerrar2");

    var cont = 0;

    var validacion = true;

    var tres_campos = false
    if (document.getElementById("email").style.display === "block") {


        tres_campos = true;


        var email = document.getElementById("email");
        email.style.borderColor = "white"
        valorEmail = email.value;

        var error_correo = document.getElementById("error_correo");
        error_correo.style.display = "none";

        mal_correo = false;

        if (valorEmail == null || valorEmail.length == 0 || /^\s+$/.test(valorEmail)) {
            error_correo.style.display = "block";
            validacion = false;
            mal_correo = true;

        } else if (!(/\S+@\S+.\S+/.test(valorEmail))) {
            error_correo.style.display = "block";
            validacion = false;
            mal_correo = true;
        } else {
            error_correo.style.display = "none";
        }


        if (mal_correo == true) {
            cont = cont + 1;

        }
    }





    var asunto = document.getElementById("asunto");
    asunto.style.borderColor = "white"
    valorasunto = asunto.value;


    var error_asunto = document.getElementById("error_asunto");
    error_asunto.style.display = "none";


    if (valorasunto == null || valorasunto.length == 0 || /^\s+$/.test(valorasunto)) {

        error_asunto.style.display = "block";
        validacion = false;
        cont = cont + 1;

    } else {
        error_asunto.style.display = "none";
    }





    var mensaje = document.getElementById("mensaje");
    mensaje.style.borderColor = "white"
    valormensaje = mensaje.value;

    var error_mensaje = document.getElementById("error_mensaje");
    error_mensaje.style.display = "none";


    if (valormensaje == null || valormensaje.length == 0 || /^\s+$/.test(valormensaje)) {

        error_mensaje.style.display = "block";
        validacion = false;
        cont = cont + 1;

    } else {
        error_mensaje.style.display = "none";
    }

    if (tres_campos == true) {
        if (cont == 1) {
            cerrar2.style.top = "-240px"
        } else if (cont == 2) {
            cerrar2.style.top = "-250px"
        } else if (cont == 3) {
            cerrar2.style.top = "-260px"
        }
    } else {
        if (cont == 1) {
            cerrar2.style.top = "-205px"
        } else if (cont == 2) {
            cerrar2.style.top = "-210px"
        }
    }


    if (!validacion) {
        return false;
    }

    // PANTALLA DE CARGA
    var form = document.getElementById("form");
    var loading = document.getElementById("loading");

    if (form.style.display != "none") {
        form.style.display = "none";
        loading.style.display = "block";
    } else {
        form.style.display = "block";
    }
}
//------------------------------------------------------------------
//--------------------MODAL FORMULARIO CREAR ALUMNOS----------------
//------------------------------------------------------------------


function validarcrearalumno() {

    var cerrar = document.getElementById("cerrar");

    var cont = 0;

    var validacion = true;
    var nombre = document.getElementById("nombre");
    nombre.style.borderColor = "white"
    valor_nombre = nombre.value;

    var error_nombre = document.getElementById("error_nombre");
    error_nombre.style.display = "none";

    if (valor_nombre == null || valor_nombre.length == 0 || /^\s+$/.test(valor_nombre)) {
        // alert('Debes de introducir el campo del email');

        error_nombre.style.display = "block";
        validacion = false;
        cont = cont + 1;

    } else {
        error_nombre.style.display = "none";
    }




    var primer_apellido = document.getElementById("primer_apellido");
    primer_apellido.style.borderColor = "white"
    valor_primer_apellido = primer_apellido.value;


    var error_primer_apellido = document.getElementById("error_primer_apellido");
    error_primer_apellido.style.display = "none";

    if (valor_primer_apellido == null || valor_primer_apellido.length == 0 || /^\s+$/.test(valor_primer_apellido)) {
        // alert('Debes de introducir el campo del email');
        error_primer_apellido.style.display = "block";
        validacion = false;
        cont = cont + 1;

    } else {
        error_primer_apellido.style.display = "none";
    }

    var segundo_apellido = document.getElementById("segundo_apellido");
    segundo_apellido.style.borderColor = "white"
    valor_segundo_apellido = segundo_apellido.value;

    var error_segundo_apellido = document.getElementById("error_segundo_apellido");
    error_segundo_apellido.style.display = "none";

    if (valor_segundo_apellido == null || valor_segundo_apellido.length == 0 || /^\s+$/.test(valor_segundo_apellido)) {
        // alert('Debes de introducir el campo del email');
        error_segundo_apellido.style.display = "block";
        validacion = false;
        cont = cont + 1;

    } else {
        error_segundo_apellido.style.display = "none";
    }


    var dni_alu = document.getElementById("dni_alu");
    dni_alu.style.borderColor = "white"
    valor_dni = dni_alu.value;

    var error_dni = document.getElementById("error_dni");
    error_dni.style.display = "none";

    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];


    var dni = valor_dni;

    var numero = dni.slice(0, 8);
    var letra = dni.slice(8, 9);
    // alert(numero)
    // alert(letra)
    var mal_dni = false;

    if (valor_dni == null || valor_dni.length == 0 || /^\s+$/.test(valor_dni)) {
        // alert('Debes de introducir el campo del email');
        validacion = false;
        error_dni.style.display = "block";
        mal_dni = true;

    } else if (!(valor_dni.length == 9)) {
        validacion = false;
        error_dni.style.display = "block";
        mal_dni = true;

    } else if ((numero < 0 || numero > 99999999)) {
        validacion = false;
        error_dni.style.display = "block";
        mal_dni = true;

    } else {
        if (numero.length != 8) {
            validacion = false;
            error_dni.style.display = "block";
            mal_dni = true;
        } else {
            // var letra_usu = prompt("Dime la letra")

            var letra_usu = numero % 23;


            var letra_def = letras[letra_usu];

            // alert(letra_def)

            if (letra.toUpperCase() == letra_def) {
                error_dni.style.display = "none";
            } else {
                validacion = false;
                error_dni.style.display = "block";
                mal_dni = true;
            }
        }

    }


    if (mal_dni == true) {
        cont = cont + 1;
    }

    var e_mail = document.getElementById("e_mail");
    e_mail.style.borderColor = "white"
    valor_e_mail = e_mail.value;

    var error_email = document.getElementById("error_email");
    error_email.style.display = "none";

    var mal_correo = false;

    if (valor_e_mail == null || valor_e_mail.length == 0 || /^\s+$/.test(valor_e_mail)) {
        // alert('Debes de introducir el campo del email');
        validacion = false;
        error_email.style.display = "block";
        mal_correo = true;

    } else if (!(/\S+@\S+.\S+/.test(valor_e_mail))) {

        validacion = false;
        error_email.style.display = "block";
        mal_correo = true;

    } else {
        error_email.style.display = "none";
    }


    if (mal_correo == true) {
        cont = cont + 1
    }

    if (cont == 1) {
        cerrar.style.top = "-190px"
    } else if (cont == 2) {
        cerrar.style.top = "-200px"
    } else if (cont == 3) {
        cerrar.style.top = "-210px"
    } else if (cont == 4) {
        cerrar.style.top = "-220px"
    } else if (cont == 5) {
        cerrar.style.top = "-230px"
    }


    if (!validacion) {
        return false;

    }
}