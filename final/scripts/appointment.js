document.addEventListener('DOMContentLoaded', function() {
    // Elements for appointment booking
    const appointmentForm = document.getElementById('appointment-form');
    const appointmentConfirmation = document.getElementById('appointment-confirmation');

    // Elements for managing appointments
    const manageAppointmentForm = document.getElementById('manage-appointment-form');
    const rescheduleOptions = document.getElementById('reschedule-options');
    const rescheduleConfirmation = document.getElementById('reschedule-confirmation');
    const actionSelect = document.getElementById('action');

    // Buttons for PDF generation
    const downloadButton = document.getElementById('downloadButton');
    const downloadButtonReschedule = document.getElementById('downloadButtonReschedule');

    // Show reschedule options based on selected action
    if (actionSelect) {
        actionSelect.addEventListener('change', function() {
            const action = this.value;
            if (action === 'reschedule') {
                rescheduleOptions.style.display = 'block';
            } else {
                rescheduleOptions.style.display = 'none';
            }
        });
    }

    // Handle appointment form submission
    if (appointmentForm) {
        appointmentForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(appointmentForm);

            fetch('appointment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hide appointment form and show confirmation
                    appointmentForm.style.display = 'none';
                    appointmentConfirmation.style.display = 'block';

                    // Update confirmation details
                    document.getElementById('confirmName').innerText = data.data.name || '';
                    document.getElementById('confirmService').innerText = data.data.service || '';
                    document.getElementById('confirmDate').innerText = data.data.date || '';
                    document.getElementById('confirmTime').innerText = data.data.time || '';
                    document.getElementById('confirmEmail').innerText = data.data.email || '';
                    document.getElementById('confirmPhone').innerText = data.data.phone || '';

                    // Show local alert
                    alert('Your appointment has been successfully booked!');
                } else {
                    console.error('Server-side error:', data.message);
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('An error occurred while booking your appointment.');
            });
        });
    }

    // Handle manage appointment form submission
    if (manageAppointmentForm) {
        manageAppointmentForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(manageAppointmentForm);
            const action = formData.get('action');
            
            if (action === 'reschedule') {
                const email = formData.get('email-manage');
                const phone = formData.get('phone-manage');
                const newDate = formData.get('new-date');
                const newTime = formData.get('new-time');

                // Normally, you'd submit this data to the server
                // For demo purposes, we will simulate successful rescheduling

                document.getElementById('confirmNameReschedule').innerText = 'User'; // Update as needed
                document.getElementById('confirmServiceReschedule').innerText = 'Service'; // Update as needed
                document.getElementById('confirmDateReschedule').innerText = newDate;
                document.getElementById('confirmTimeReschedule').innerText = newTime;
                document.getElementById('confirmEmailReschedule').innerText = email;
                document.getElementById('confirmPhoneReschedule').innerText = phone;

                // Hide the form and show reschedule confirmation
                manageAppointmentForm.style.display = 'none';
                rescheduleConfirmation.style.display = 'block';
                
                alert('Your appointment has been rescheduled successfully!');
            } else if (action === 'cancel') {
                // Handle cancellation logic
                alert('Your appointment has been canceled.');

                // Hide confirmation and show the form again
                manageAppointmentForm.style.display = 'block';
                rescheduleOptions.style.display = 'none';
                rescheduleConfirmation.style.display = 'none';
            }
        });
    }

    // Functions to generate PDF and go back
    function generatePDF(isReschedule = false) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        if (isReschedule) {
            if (rescheduleConfirmation.style.display === 'block') {
                const name = document.getElementById('confirmNameReschedule').innerText || '';
                const service = document.getElementById('confirmServiceReschedule').innerText || '';
                const date = document.getElementById('confirmDateReschedule').innerText || '';
                const time = document.getElementById('confirmTimeReschedule').innerText || '';
                const email = document.getElementById('confirmEmailReschedule').innerText || '';
                const phone = document.getElementById('confirmPhoneReschedule').innerText || '';

                doc.text("Reschedule Receipt", 10, 10);
                doc.text("Thank you for rescheduling with us!", 10, 20);
                doc.text(`Name: ${name}`, 10, 30);
                doc.text(`Service: ${service}`, 10, 40);
                doc.text(`New Date: ${date}`, 10, 50);
                doc.text(`New Time: ${time}`, 10, 60);
                doc.text(`Email: ${email}`, 10, 70);
                doc.text(`Phone: ${phone}`, 10, 80);
            }
        } else {
            if (appointmentConfirmation.style.display === 'block') {
                const name = document.getElementById('confirmName').innerText || '';
                const service = document.getElementById('confirmService').innerText || '';
                const date = document.getElementById('confirmDate').innerText || '';
                const time = document.getElementById('confirmTime').innerText || '';
                const email = document.getElementById('confirmEmail').innerText || '';
                const phone = document.getElementById('confirmPhone').innerText || '';

                doc.text("Appointment Receipt", 10, 10);
                doc.text("Thank you for booking with us!", 10, 20);
                doc.text(`Name: ${name}`, 10, 30);
                doc.text(`Service: ${service}`, 10, 40);
                doc.text(`Date: ${date}`, 10, 50);
                doc.text(`Time: ${time}`, 10, 60);
                doc.text(`Email: ${email}`, 10, 70);
                doc.text(`Phone: ${phone}`, 10, 80);
            }
        }
        doc.save(isReschedule ? 'reschedule-receipt.pdf' : 'appointment-receipt.pdf');
    }

    if (downloadButton) {
        downloadButton.addEventListener('click', function() {
            generatePDF(false); // Generate appointment PDF
        });
    }

    if (downloadButtonReschedule) {
        downloadButtonReschedule.addEventListener('click', function() {
            generatePDF(true); // Generate reschedule PDF
        });
    }

    window.goBack = function() {
        // Reset forms and hide confirmation sections
        appointmentForm.style.display = 'block';
        appointmentConfirmation.style.display = 'none';
        
        manageAppointmentForm.style.display = 'block';
        rescheduleConfirmation.style.display = 'none';
        
        manageAppointmentForm.reset();
        appointmentForm.reset();
    };
});
