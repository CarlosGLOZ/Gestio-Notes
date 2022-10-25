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


function darkMode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
  }