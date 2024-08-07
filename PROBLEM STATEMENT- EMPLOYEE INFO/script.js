// Function to capitalize the first letter of a string
function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

// Function to generate email, username, and password
function generateInfo(firstName, lastName) {
    const email = `${firstName.toLowerCase()}.${lastName.toLowerCase()}@abc.com`;
    const username = `${firstName.toLowerCase()}${capitalizeFirstLetter(lastName)}`;
    const password = `${lastName.toLowerCase()}#${capitalizeFirstLetter(firstName)}`;

    return { email, username, password };
}

// Function to display the formatted information
function displayInfo(names) {
    const outputElement = document.getElementById('solution');
    let outputHTML = '';

    names.forEach(name => {
        const [firstName, lastName] = name.split('_');
        const { email, username, password } = generateInfo(firstName, lastName);
        
        outputHTML += `
            <h2>${firstName} ${lastName}</h2>
            <p>${email}</p>
            <p>${username}</p>
            <p>${password}</p>
        `;
    });

    outputElement.innerHTML = outputHTML;
}

// Sample input
const input = 'Michael_John Tina_Kim Sachi_Bala';
const names = input.split(' ');

// Display the information on the page
displayInfo(names);
