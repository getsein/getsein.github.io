/*NEW FORM */

const btn = document.getElementById('button');

document.getElementById('form')
    .addEventListener('submit', function (event) {
        event.preventDefault();

        btn.value = 'Sending...';

        const serviceID = 'default_service';
        const templateID = 'template_qjv1yy9';

        emailjs.sendForm(serviceID, templateID, this)
            .then(() => {
                btn.value = 'Send';
            
            }, (err) => {
                btn.value = 'Send';
    
            }           
            );

    });

    const button = document.getElementById("button");
    const inputId = document.getElementById("input-Id");
    
            button.addEventListener("click", function () {
              inputId.value = "";

            });
