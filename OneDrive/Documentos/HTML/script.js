document.addEventListener("DOMContentLoaded", function() {

    const characterList = document.getElementById("character-list");


    function fetchCharacters() {

        const url = 'https://rickandmortyapi.com/api/character/?page=19';
                fetch(url)
            .then((response) => response.json()) 
            .then((data) => {
                displayCharacters(data.results); 
            })
            .catch((error) => {
                console.error("Erro ao buscar os personagens:", error); 
            });
    }


    function displayCharacters(characters) {
        characterList.innerHTML = ''; 


        characters.forEach((character) => {

            const characterCard = document.createElement("div");
            characterCard.classList.add("character-card"); 

            characterCard.innerHTML = `
                <img src="${character.image}" alt="${character.name}">
                <div class="card-body">
                    <h2>${character.name}</h2>
                    <p>Status: ${character.status}</p>
                    <p>Espécie: ${character.species} ${character.type ? `- ${character.type}` : ''}</p>
                    <p>Origem: ${character.origin.name}</p>
                    <p>Localização: ${character.location.name}</p>
                </div>
            `;


            characterList.appendChild(characterCard);
        });
    }

  
    fetchCharacters();
});
