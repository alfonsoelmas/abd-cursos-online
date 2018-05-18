$(document).ready(function() {
    $('#register').submit(function(e) { e.preventDefault(); }).validate(
    { 
        debug: true,
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        
        rules: {
            "nombre": {
                required: true
            },
            "ape1": {
                required: true
            },
            "edad":{
                required: true,
                number: true
            },
            "ape2":{
                required: true
            },
            "email": {
                required: true,
                email: true
            },
            "emailr": {
                required: true,
                email: true,
                equalTo: "#email"
            },
            "pass":{
                required: true,
                minlength: "6"
            },
            "passr":{
                required: true,
                equalTo:"#pass"
            }
        },

        messages: {
            "nombre": {
                required: "Introduce tu nombre."
            },
            "ape1": {
                required: "Introduce tu primer apellido."
            },
            "edad":{
                required: "Introduce tu edad.",
                number: "La edad debe ser un numero."
            },
            "ape2":{
                required: "Introduce tu segundo apellido."
            },
            "email": {
                required: "Introduce tu correo.",
                email: "Introduce un email válido."
            },
            "emailr": {
                required: "Introduce tu correo.",
                email: "Introduce un email válido.",
                equalTo: "El email debe ser igual al email indicado anteriormente."
            },
            "pass":{
                required: "Introduce la contraseña.",
                minlength: "La contraseña debe tener una longitud minima de 6 caracteres."
            },
            "passr":{
                required: "Introduce la contraseña de nuevo.",
                equalTo: "La contraseña debe ser igual a la contraseña indicada anteriormente."
            }
        },

        submitHandler: function(form){
            form.submit();
        }
    });


});
