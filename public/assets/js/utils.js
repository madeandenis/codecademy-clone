/**
 * 
 * Logout Action 
 * 
 */
// Send POST request to logout endpoint
function logoutUser() {
    const logoutUrl = 'https://codecademyre.com/logout';

    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    };

    fetch(logoutUrl,requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            window.location.href = 'https://codecademyre.com/login';
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
}