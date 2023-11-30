document.getElementById("signUp_form").addEventListener("submit", function (event) {
    if (!validateForm()) {  // if the validation of the form fails, we will not submit the form.                             
        event.preventDefault(); // prevents the form from submitting.
    }
    // else {
    //     if (!confirm("Confirm Submission of Feedback Form?")) { // if form not confirmed to submit , we will not submit the form         
    //         event.preventDefault(); // prevents the form from submitting.
    //     }
    // }
    // if we get to this line, the form will be ok to be submitted to server
});

function validateForm() {
    var formOK = true;
    var Fullname = document.getElementById("Fullname").value;
    var email = document.getElementById("Email").value;
    var password = document.getElementById("Password").value;
    var cfmPassword = document.getElementById("CfmPassword").value;

    // clear and hide any error messages before we validate [again] (could be a re-validation attempt)
    clearErrorMsgs();

    // name field validations
    if (Fullname.length == 0) {
        formOK = false;
        showError(document.getElementById("name_err"), "Please enter a name.");
    }
    else if (!validateName(Fullname)) {
        formOK = false;
        showError(document.getElementById("name_err"), "Name must contain only alphabets");
    }
    // 12345678

    // password field validations
    if (password.length < 8 || password.length > 16) {
        formOK = false;
        showError(document.getElementById("pass_err"), "Your password must be more than 8 characters and not more than 16 characters.");
    }
    else if (password != cfmPassword) {
        formOK = false;
        showError(document.getElementById("pass_err"), "Your password does not match.");
    }

    // email field validations
    else if (email.length == 0) {
        formOK = false;
        showError(document.getElementById("email_err"), "Please enter an email address.");
    }
    else if (!validateEmail(email)) {
        formOK = false;
        showError(document.getElementById("email_err"), "Please enter a valid email address.");
    }

    return formOK;
}

function validateName(str) {
    let pattern = /^[a-zA-Z\s]+$/; // must contain small cap or large caps or space
    return pattern.test(str); // using regex check that all characters are letters/space in the string.
}

function validateMobile(str) {
    // a shorter way to test regex
    return /^\d{8}$/.test(str); // using regex to ensure all 8 characters in string are numbers.
}

function validateEmail(str) {
    // using regex again to validate email address: go to https://regexr.com/ and see the meaning of this regex expression below
    return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(str);
}

// clears the error messages
function clearErrorMsgs() {
    document.getElementById("pass_err").innerHTML = "";
    document.getElementById("pass_err").style.display = "none";
    document.getElementById("email_err").innerHTML = "";
    document.getElementById("email_err").style.display = "none";
    document.getElementById("name_err").innerHTML = "";
    document.getElementById("name_err").style.display = "none";
}

function showError(element, msg) {
    element.style.display = "block"; // set the element to be visible
    element.innerHTML = msg; // set the error message in the HTML element
}