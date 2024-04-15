const ajax = new Ajax();

const searchInput= document.getElementById('searchInput');
const searchResultsContainer= document.getElementById('search-results');
const screenWidth = window.innerWidth;

/*window.addEventListener('load', adjustSize);
window.addEventListener('resize', adjustSize);*/

/*function adjustSize() {

}*/

function liveSearch() {
    const searchTerm = searchInput.value.trim();

    ajax.get(`get.php?search=${searchTerm}`, (error, response) => {
        if(error) {
            console.error('Error', error);
        } else {
            const results = JSON.parse(response);
            displaySearchResults(results);
        }
    });
}

function displaySearchResults(results) {
    searchResultsContainer.innerHTML = '';

    if(results.length === 0) {
        searchResultsContainer.innerHTML = '<p> No results found </p>';
    } else {
        results.forEach(result => {
            const resultElement = document.createElement('div');
            resultElement.innerHTML = `
                <p><strong>ID:</strong> ${result.deliveryID}</p>
                <p><strong>Name:</strong> ${result.name}</p>
                <p><strong>Address:</strong> ${result.address1}, ${result.address2}</p>
                <p><strong>Postcode:</strong> ${result.postcode}</p>
                <p><strong>Deliverer:</strong> ${result.deliverer}</p>
                <p><strong>Status:</strong> ${result.status}</p>
                <br>
            `;
            searchResultsContainer.appendChild(resultElement);
            searchResultsContainer.style.height = '244px';
            searchResultsContainer.style.top = '100%';
            searchResultsContainer.style.width = '344px';
            searchResultsContainer.style.left = '50%';
            searchResultsContainer.style.transform = 'translateX(-50%)';

            if (screenWidth <= 1424 && screenWidth > 992) { // Medium-size screens
                searchResultsContainer.style.left = '84%';
                searchResultsContainer.style.transform = 'translateX(-50%)';
            } else if (screenWidth <= 992) { // Small-size screens
                searchResultsContainer.style.left = '50%';
                searchResultsContainer.style.transform = 'translateX(-50%)';
            }

            searchResultsContainer.style.backgroundColor = '#ffff';
            searchResultsContainer.style.padding = '0.8rem 0 0 0.8rem';
            searchResultsContainer.style.boxShadow = '1px 2px 3px rgba(0, 0, 0, 0.1)';
            searchResultsContainer.style.overflow = 'hidden';
            searchResultsContainer.style.position = 'absolute';
        });
    }
}

function cleanSearchResults() {
    searchResultsContainer.style.display = 'none';
}

searchInput.addEventListener('input', () => {
    liveSearch();
});

searchInput.addEventListener('change', () => {
    cleanSearchResults();
});