document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registration-form');
    const firstNameInput = document.getElementById('first-name');
    const lastNameInput = document.getElementById('last-name');
    const usernameInput = document.getElementById('username');
    const profilePictureInput = document.getElementById('profile-picture-input');
    const profilePicture = document.getElementById('profile-picture');
    
    const generateUsername = () => {
        const firstName = firstNameInput.value;
        const lastName = lastNameInput.value;
        const randomNumber = Math.floor(Math.random() * 1000);
        usernameInput.value = `${firstName}${lastName}${randomNumber}`;
    };

    firstNameInput.addEventListener('input', generateUsername);
    lastNameInput.addEventListener('input', generateUsername);
    
    profilePictureInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                profilePicture.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        // Perform form validation and AJAX request to submit the form data
        console.log("Form submitted");
        // You can add your AJAX code here to send data to the server
    });
});
