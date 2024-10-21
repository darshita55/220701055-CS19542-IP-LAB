document.addEventListener("DOMContentLoaded", function () {
    const addPatientBtn = document.getElementById("addPatientBtn");
    const bookAppointmentBtn = document.getElementById("bookAppointmentBtn");
    const contactForm = document.getElementById("contactForm");

    addPatientBtn.addEventListener("click", function () {
        alert("Add Patient functionality to be implemented.");
    });

    bookAppointmentBtn.addEventListener("click", function () {
        alert("Book Appointment functionality to be implemented.");
    });

    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();
        alert("Your message has been sent!");
        contactForm.reset();
    });
});
