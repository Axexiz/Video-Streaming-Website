document.getElementById("change_emailForm").addEventListener("submit", function (event) {
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
    var email = document.getElementById("Email").value;

    // clear and hide any error messages before we validate [again] (could be a re-validation attempt)
    clearErrorMsgs();

    // email field validations
    if (email.length == 0) {
        formOK = false;
        showError(document.getElementById("email_err"), "Please enter an email address.");
    }
    else if (!validateEmail(email)) {
        formOK = false;
        showError(document.getElementById("email_err"), "Please enter a valid email address.");
    }

    return formOK;
}
function validateEmail(str) {
    // using regex again to validate email address: go to https://regexr.com/ and see the meaning of this regex expression below
    return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(str);
}

// clears the error messages
function clearErrorMsgs() {
    document.getElementById("email_err").innerHTML = "";
    document.getElementById("email_err").style.display = "none";
}

function showError(element, msg) {
    element.style.display = "block"; // set the element to be visible
    element.innerHTML = msg; // set the error message in the HTML element
}