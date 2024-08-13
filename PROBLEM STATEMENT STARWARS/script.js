document.addEventListener("DOMContentLoaded", function() {
    const characterInfoDiv = document.getElementById("character-info");

    // Fetch character data from the API
    fetch('https://swapi.dev/api/people/1/')
        .then(response => response.json())
        .then(data => {
            displayCharacterInfo(data);
        })
        .catch(error => console.error('Error fetching character data:', error));

    async function displayCharacterInfo(character) {
        const name = character.name;
        const films = await Promise.all(character.films.map(fetchNameFromURL));
        const vehicles = await Promise.all(character.vehicles.map(fetchNameFromURL));
        const starships = await Promise.all(character.starships.map(fetchNameFromURL));

        const characterInfo = `
            <h2>Name: ${name}</h2>
            <h3>Films:</h3>
            <ul>${films.map(film => `<li>${film}</li>`).join('')}</ul>
            <h3>Vehicles:</h3>
            <ul>${vehicles.map(vehicle => `<li>${vehicle}</li>`).join('')}</ul>
            <h3>Starships:</h3>
            <ul>${starships.map(starship => `<li>${starship}</li>`).join('')}</ul>
        `;

        characterInfoDiv.innerHTML = characterInfo;
    }

    // Helper function to fetch name from a URL
    async function fetchNameFromURL(url) {
        const response = await fetch(url);
        const data = await response.json();
        return data.title || data.name; // 'title' for films, 'name' for others
    }
});
