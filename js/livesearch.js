/*
This JavaScript code manages live search functionality for delivery points,
displaying search results dynamically. The code initializes an instance
of the Ajax class for making AJAX requests to fetch search results from the API
based on user input. Event listeners are set up to trigger live search and clean
search results when the user interacts with the search input.
*/

// Initialises an instance of the Ajax class for making AJAX requests.
const ajax = new Ajax();
// Base URL for the local server
const baseUrl = window.location.origin + "/css/parcelbuddy/";

// Select search input and search results container from the DOM
const searchInput= document.getElementById('searchInput');
const searchResultsContainer= document.getElementById('search-results');
// Get the screen width using the innerWidth property of the window interface
const screenWidth = window.innerWidth;

/*window.addEventListener('load', adjustSize);
window.addEventListener('resize', adjustSize);*/

/*function adjustSize() {

}*/

// Function that performs the live search
function liveSearch() {
    const searchTerm = searchInput.value.trim();
    // Send a GET request to the API to fetch search results based on the entered search term
    ajax.get(baseUrl + `get.php?search=${searchTerm}`, (error, response) => {
        if(error) {
            console.error('Error', error);
        } else {
            const results = JSON.parse(response);
            // Call to the displaySearchResults function
            displaySearchResults(results);
        }
    });
}

// Function to display search results in the search results container
function displaySearchResults(results) {
    searchResultsContainer.innerHTML = '';

    if(results.length === 0) {
        searchResultsContainer.innerHTML = '<p> No results found </p>';
    } else {
        // Iterates through each search result and display its details in the search results container
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

// Cleans up search results
function cleanSearchResults() {
    searchResultsContainer.style.display = 'none';
}

// Event listeners: call to the live search and clean search results functions
searchInput.addEventListener('input', () => {
    liveSearch();
});

searchInput.addEventListener('change', () => {
    cleanSearchResults();
});