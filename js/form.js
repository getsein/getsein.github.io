var btn_send = document.getElementById("sendBtn");
btn_send.addEventListener("click", sendMessage);

const name = document.getElementById("name").value;
const email = document.getElementById("email").value;
const message = document.getElementById("message").value;

function isMail() {
    /*var email_text = document.getElementById("email").value;
    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/;
    if (!regex.test(email_text)) {
        return false;
    } else {
        return true;
    }*/ return true ;
}
function isNombre() {
    /*var name_text = document.getElementById("name").value;
    var regex = [A - Za - z];
    if (!regex.test(email_text)) {
        return false;
    } else{
        return true;
    }
*/return true;
}


function sendMessage(event) {
    event.preventDefault();
    if (isNombre()) {
        if (isMail()) {
            var nameForm = (document.getElementById("name").value).trim();
            var emailForm = (document.getElementById("email").value).trim();
            var messageForm = (document.getElementById("message").value).trim();
            var connect, form, asunto, recaptcha_web_key, recaptcha_web_response;
            
            recaptcha_web_key = '6LdUv9AdAAAAABFY2Cq-42JbyofqFRaNUp_y87bC'; //copiar clave 
            // start recaptcha

            grecaptcha.ready(function () {
                grecaptcha.execute(recaptcha_web_key, { action: 'contact' }).then(function (g_token) {
                    recaptcha_web_response = (g_token != '') ? g_token : 'disabled';

                    form = 'name=' + nameForm + '&email=' + emailForm + '&message=' + messageForm + '&recaptcha_web_response=' + recaptcha_web_response;

                    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

                    connect.onreadystatechange = function () {
                        if (connect.readyState == 4 && connect.status == 200) {
                            //console.log("response: " + connect.responseText);
                            var response = JSON.parse(connect.responseText);
                            console.log(response);
                
                            if (response.success) {
                                document.getElementById("name").value = "";
                                document.getElementById("email").value = "";
                                document.getElementById("message").value = "";
                                window.location.replace('/Sein');
                                alert("Email send succefully")
                               // form_success_div.style.display = "block"; 
                            } else {
                                alert("Something went wrong please try later")
                                //form_fail_div.style.display = "block";
                            }
                        } else if (connect.readyState != 4) {
                            //Processing the request
                            //botonEnviar.innerHTML = '<p>Enviando...</p><i class="fas fa-circle-notch fa-spin"></i>'
                           // botonEnviar.disabled = true
                        }
                    };
                    connect.open("POST", "./php/form.php", true);
                    connect.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    connect.send(form);
                    // end submit form
                });
            });
            // end reCaptcha

        } else {
            alert("Mail incorrecto")
        }
    } else {
        alert("Ingrese su nombre")
    }




}
