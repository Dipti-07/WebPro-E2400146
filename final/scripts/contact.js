 (function() {
    emailjs.init("Y47HJdXXF-vjzgma8");  
})();

function SendMail(event) {
    event.preventDefault();  
    // Collect the form data
    var params = {
        from_name: document.getElementById('fullname').value,
        email_id: document.getElementById('email_id').value,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value
    };
    //  EmailJS to send the email
    emailjs.send('service_3sl9wso', 'template_mqj2r7q', params)
        .then(function(response) {      
            alert('Message sent successfully! Thank you for contacting us.');
            document.querySelector('.recieve-section').style.display = 'none';
            document.getElementById('confirmation').style.display = 'block';
        })
        .catch(function(error) {
             
            alert('Failed to send email. Please try again.');
            console.log('Failed to send email:', error);
        });
}
 
document.getElementById('form').addEventListener('submit', SendMail);

document.getElementById('BackBtn').addEventListener('click', function() {  
   document.querySelector('.recieve-section').style.display = 'block';
    document.getElementById('confirmation').style.display = 'none';
});
