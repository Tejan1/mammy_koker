--document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registration-form');
    const firstNameInput = document.getElementById('first-name');
    const lastNameInput = document.getElementById('last-name');
    const usernameInput = document.getElementById('username');
    const profilePictureInput = document.getElementById('profile-picture-input');
    const profilePicture = document.getElementById('profile-picture');
    const confirmPasswordInput = document.getElementById('confirm-password');
    
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

    

    //form.addEventListener('submit', (event) => {
      //  event.preventDefault();
        // Check if passwords match
      //  if (passwordInput.value !== confirmPasswordInput.value) {
        //    alert("Passwords do not match. Please try again.");
         //   return;
        //}else {
        // Perform form validation and AJAX request to submit the form data
        //console.log("Form submitted");
        // You can add your AJAX code here to send data to the server
    //}
    //});

});

function send_form(){

    if (passwordInput.value !== confirmPasswordInput.value) {
        alert("Passwords do not match. Please try again.");
        return;
    }else {
        document.getElementById("registration-form").submit;
        // Perform form validation and AJAX request to submit the form data
        console.log("Form submitted");
        // You can add your AJAX code here to send data to the server
}

}


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registration-form');
    const firstNameInput = document.getElementById('first-name');
    const lastNameInput = document.getElementById('last-name');
    const usernameInput = document.getElementById('username');
    const profilePictureInput = document.getElementById('profile-picture-input');
    const profilePicture = document.getElementById('profile-picture');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');

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
        // Check if passwords match
        if (passwordInput.value !== confirmPasswordInput.value) {
            alert("Passwords do not match. Please try again.");
            return;
        }
        // Perform form validation and AJAX request to submit the form data
        console.log("Form submitted");
        // You can add your AJAX code here to send data to the server
    });

    // Google Sign-In
    google.accounts.id.initialize({
        client_id: 'YOUR_GOOGLE_CLIENT_ID',
        callback: handleGoogleSignIn
    });

    google.accounts.id.renderButton(
        document.getElementById('google-signin'),
        { theme: 'outline', size: 'large' }
    );

    function handleGoogleSignIn(response) {
        // Decode JWT and extract user information
        const userObject = jwt_decode(response.credential);
        firstNameInput.value = userObject.given_name;
        lastNameInput.value = userObject.family_name;
        document.getElementById('email').value = userObject.email;
        generateUsername();
        console.log(userObject);
    }

    // Facebook Login
    window.fbAsyncInit = function() {
        FB.init({
            appId: 'YOUR_FACEBOOK_APP_ID',
            cookie: true,
            xfbml: true,
            version: 'v11.0'
        });

        FB.AppEvents.logPageView();   
    };

    document.getElementById('facebook-signin').addEventListener('click', () => {
        FB.login((response) => {
            if (response.authResponse) {
                FB.api('/me', { fields: 'first_name,last_name,email' }, (response) => {
                    firstNameInput.value = response.first_name;
                    lastNameInput.value = response.last_name;
                    document.getElementById('email').value = response.email;
                    generateUsername();
                    console.log(response);
                });
            }
        }, {scope: 'public_profile,email'});
    });
});
