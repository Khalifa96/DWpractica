(function($) {

    $('#photo').change(function() {
        var tamMaxMB = 16; //MB
        var photo = $("#photo")[0].files[0];
        if(photo !== undefined){
            var tamPhoto = photo.size;
            var tamPhotoMB = tamPhoto / Math.pow(1024,2);
            if(tamPhotoMB > tamMaxMB){
                var errorMsg = 'El fichero ocupa demasiado. El tamaño máximo permitido es de ' + tamMaxMB + 'MB. El fichero elegido posee ' + tamPhotoMB.toFixed(2) + 'MB';
                alert(errorMsg);
                return false;
            }
            console.log("Tam fichero: "+tamPhotoMB.toFixed(2)+"MB");
        }
    });

    $('#rEMP').submit(function() {
        console.log("vamos a comprobar los campos de este empleado");
        $("#error").remove();
        var username = $("#username").val(), 
            passwd = $("#passwd").val(),
            nombre = $("#nombre").val(),
            apell = $("#apell").val(),
            email = $("#email").val(),
            cargo = $("#cargo").val(),
            tiendaId = $("#tiendaId").val(),
            passwdConfirm = $("#passwdConfirm").val();

        var inputVal = [username, passwd, nombre, apell, email, cargo, tiendaId, passwdConfirm],
            inputMessage = ["username", "contraseña", "nombre", "apellidos", "email", "cargo", "tienda id", "contraseña de confirmación"],
            textId = ["#lUsername", "#lPasswd", "#lNombre", "#lApell", "#lEmail", "#lCargo", "lTiendaId", "#lPasswdConfirm"];

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            console.log(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                invalidEntry(i);
                return false;
            }
        }
        if( !isEmail(email) ){
            console.log("Email incorrecto");
            invalidEntry(4);
            return false;
        }
        console.log("Registro completado");
        return true;

        function invalidEntry(i) {
            console.log(textId[i] + ' incorrecto');
            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
        }
        function isEmail(email) {
            console.log(email)
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(email);
        }
    });

    $("input[type='text']").change(function() {
        $("#error").remove();
    });

    $('#aSHOP').submit(function() {     
        console.log("vamos a comprobar los campos de esta tienda");
        $("#error").remove();
        var nombreTienda = $("#nombreTienda").val(), 
            direccion = $("#direccion").val(),
            emailTienda = $("#emailTienda").val(),
            cp = $("#cp").val(),
            passwdConfTienda = $("#passwdConfTienda").val();

        var inputVal = [nombreTienda, direccion, emailTienda, cp, passwdConfTienda],
            inputMessage = ["nombre tienda", "direccion", "email", "código postal", "contraseña de confirmación"],
            textId = ["#lNombreTienda", "#lDireccion", "#lEmailTienda", "#lCp", "#lPasswdConfTienda"];

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            console.log(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                invalidEntry(i);
                return false;
            }
        }
        if( !isEmail(emailTienda) ){
            console.log("Email incorrecto");
            invalidEntry(2);
            return false;
        }else if( !isCp(cp) ){
            console.log("CP incorrecto");
            invalidEntry(3);
            return false;
        }
        console.log("Registro completado");
        return true;

        function invalidEntry(i) {
            console.log(textId[i] + ' incorrecto');
            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
        }
        function isCp(cp){
            console.log(cp);
            var regexCp = /^[0-9]{5}$/;
            return regexCp.test(cp);
        }
        function isEmail(email) {
            console.log(email);
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(email);
        }
        
    });

    $('#bajaEMP').submit(function() {
        $("#error").remove();
        var idBajaEmpleado = $("#idBajaEmpleado").val(), 
            passwdConfBaja = $("#passwdConfBaja").val();

        var inputVal = [idBajaEmpleado, passwdConfBaja],
            inputMessage = ["username Empleado", "contraseña confirmación"],
            textId = ["#lIdBajaEmpleado", "#lPasswdConfBaja"];

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            console.log(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                invalidEntry(i);
                return false;
            }
        }
        console.log("Registro completado");
        return true;

        function invalidEntry(i) {
            console.log(textId[i] + ' incorrecto');
            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
        }
    });



})(jQuery);