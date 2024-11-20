// scripts.js

// Function to validate the doctor form
function validateForm(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form values
    const name = document.getElementById('name').value.trim();
    const specialty = document.getElementById('specialty').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();

    // Simple validation checks
    if (name === '' || specialty === '') {
        alert('Name and Specialty are required fields.');
        return false; // Stop form submission
    }

    if (phone && !/^\d{10}$/.test(phone)) {
        alert('Please enter a valid phone number (10 digits).');
        return false; // Stop form submission
    }

    if (email && !/\S+@\S+\.\S+/.test(email)) {
        alert('Please enter a valid email address.');
        return false; // Stop form submission
    }

    // If validation passes, proceed with AJAX submission
    submitForm();
}

// Function to submit the form data via AJAX
function submitForm() {
    const form = document.getElementById('doctorForm');
    const formData = new FormData(form); // Create FormData object from the form

    fetch('manage_doctor.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            // Display the response data (for example, success message or updated doctor list)
            document.getElementById('doctorList').innerHTML = data;
            form.reset(); // Reset the form fields
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the form. Please try again.');
        });
}

// Event listener for form submission
document.getElementById('doctorForm').addEventListener('submit', validateForm);
