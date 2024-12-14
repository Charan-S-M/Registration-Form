$(document).ready(function () {
    $("#registrationForm").on("submit", function (e) {
        const phone = $("#phone").val();
        const phoneRegex = /^[0-9]{10}$/;

        if (!phoneRegex.test(phone)) {
            alert("Please enter a valid 10-digit phone number.");
            e.preventDefault(); // Prevent form submission
        }
    });
});
