$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        const email = $('#email').val();

        $.ajax({
            type: 'POST',
            url: 'send_verification.php',
            data: { email: email },
            success: function(response) {
                if (response === 'success') {
                    $('#verifyModal').modal('show');
                } else {
                    alert(response);
                }
            }
        });
    });

    $('#verifyButton').on('click', function() {
        const code = $('#verificationCode').val();
        const email = $('#email').val();

        $.ajax({
            type: 'POST',
            url: 'verify_code.php',
            data: { code: code, email: email },
            success: function(response) {
                if (response === 'verified') {
                    alert('Verification successful! You can now log in.');
                    // Redirect to admin panel or perform further actions
                } else {
                    alert('Invalid verification code. Please try again.');
                }
            }
        });
    });
});