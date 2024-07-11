document.addEventListener('DOMContentLoaded', () => {
    // Google Sign-In
    google.accounts.id.initialize({
        client_id: '291963249242-p3i1eg8682k1u9shtm07mg3h096jjfd1.apps.googleusercontent.com',
        callback: handleGoogleSignIn
    });

    google.accounts.id.renderButton(
        document.getElementById('google-signin'),
        { theme: 'outline', size: 'large' }
    );

    function handleGoogleSignIn(response) {
        // Decode JWT and extract user information
        const userObject = jwt_decode(response.credential);
        console.log(userObject);
        // we'll have to perform the login or redirect 
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
                    console.log(response);
                    // Perform the login or redirect to your application
                });
            }
        }, { scope: 'email' });
    });
});
