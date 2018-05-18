$(document).ready(function() {
    $('#log').submit(function(e) { e.preventDefault(); }).validate(
    { 
        debug: true,
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        
        rules: {
           
            "email": {
                required: true,
                email: true
            },
           
            "pass":{
                required: true,
                minlength: "6"
            }
        },

        messages: {
            
            "email": {
                required: "Introduce tu correo.",
                email: "Introduce un email válido."
            },
            "password":{
                required: "Introduce la contraseña.",
                minlength: "La contraseña debe tener una longitud minima de 6 caracteres."
            }
        },

        submitHandler: function(form){
            form.submit();
        }
    });
}