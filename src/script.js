// Script.js - JavaScript Events

// If page is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    passwordToggle();
    translateHeroTextForMobile();
    learnerHubSPAFunction();
    learnerSelect();
    checkPhoneNum();

});

////// functions //////

// password visibility toggle
function passwordToggle()
{
     // Get the toggler itself
     const toggler = document.getElementById("togglePassword");

     // If toggler exists...
     if (toggler)
     {
         // Initialize visible variable to check if password is visible or not
         // Get the password input element
         let visible = false;
         const passInput = document.getElementsByName("password")[0];
 
         // Event listener for the click event, checks status of visible and changes password visibility and icon accordingly
         toggler.addEventListener("click", () => {
             if (visible)
             {
                 visible = false;
                 passInput.type = "password";
                 toggler.removeChild(toggler.firstElementChild);
                 const openEye = document.createElement("div")
                 openEye.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"> <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/></svg>';
                 toggler.appendChild(openEye);
             }
             else
             {
                 visible = true;
                 passInput.type = "text";
                 toggler.removeChild(toggler.firstElementChild);
                 const closedEye = document.createElement("div");
                 closedEye.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/><path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/></svg>';
                 toggler.appendChild(closedEye);
             }
         });
    }
}

/// fix hero_text bug on mobile
function translateHeroTextForMobile()
{
    // get the menu button
    const menuBtn = document.getElementsByClassName("navbar-toggler")[0];

    // If the button exists
    if (menuBtn)
    {
         // check if nav menu is showing
         let clicked = false;
        menuBtn.addEventListener("click", () => {

            // get hero text
            const heroText = document.getElementsByClassName("hero_text")[0];

            if (clicked)
            {
                clicked = false;
                heroText.style.transform = "translate(-50%,-200%)";
            }
            else
            {
                clicked = true;
                heroText.style.transform = "translate(-50%,-6%)";
            }
        });
    }
};

/// Function that essentially makes learner_hub.php a SPA, so that 
// a parent can register, delete and edit a learner all on one page
function learnerHubSPAFunction()
{
    // Get the buttons used on the page
    const registerBtn = document.getElementById("registerBtn");
    const editBtn = document.getElementById("editBtn");
    const removeBtn = document.getElementById("removeBtn");

    // Check if buttons exist
    if (registerBtn && editBtn && removeBtn)
    {
        // Other elements like the title and sections themselves
        const title = document.getElementById("title");
        const register = document.getElementById("register");
        const edit = document.getElementById("edit");
        const remove = document.getElementById("remove");
        const subtitle = document.getElementById("subtitle");

        // Initial display
        register.style.display = "block";
        edit.style.display = "none";
        remove.style.display = "none";

        // Add onclick event listeners for each button
        registerBtn.addEventListener("click", () => {
            title.textContent = "Register a Learner";
            registerBtn.className = "btn btn-primary";
            editBtn.className = "btn btn-secondary";
            removeBtn.className = "btn btn-secondary";
            register.style.display = "block";
            edit.style.display = "none";
            remove.style.display = "none";
            subtitle.textContent = "Fill in the form below to register your child on the system!";
        });
        editBtn.addEventListener("click", () => {
            title.textContent = "Edit a Learner's Details";
            registerBtn.className = "btn btn-secondary";
            editBtn.className = "btn btn-primary";
            removeBtn.className = "btn btn-secondary";
            register.style.display = "none";
            edit.style.display = "block";
            remove.style.display = "none";
            subtitle.textContent = "Edit a learner's details by completing the form below. The fields are enabled as you hover your cursor/pointer over them.";
        });
        removeBtn.addEventListener("click", () => {
            title.textContent = "Remove a Learner";
            registerBtn.className = "btn btn-secondary";
            editBtn.className = "btn btn-secondary";
            removeBtn.className = "btn btn-primary";
            register.style.display = "none";
            edit.style.display = "none";
            remove.style.display = "block";
            subtitle.textContent = "Remove a learner from the system by completing the form below.";
        });
    }
}

// function that prevents users from using the edit learners form until
// they select a learner
function learnerSelect()
{
    let learners;

    // get the select element where learners are selected
    const options = document.getElementsByName("selected_learner")[0];

    // Get the information of the learners
    fetch("../index.php?action=get_learners")
    .then(response => (response.json()))
    .then(data => (learners = data))
    .catch(error => console.log(error));

    // Check for when the value of options changes
    options.addEventListener("change", () => {
        const learnerInfo = learners[options.selectedIndex - 1];
        const edit_learner = document.getElementById("edit_learner");

        // if the form exists
        if (edit_learner)
        {
            // if the form is not displaying
            if (edit_learner.style.display = "none")
            {
                // show the form and get access to its elements
                edit_learner.style.display = "block";
                let name = document.getElementsByName("e_name")[0];
                let surname = document.getElementsByName("e_surname")[0];
                let cell_num = document.getElementsByName("e_cell_num")[0];
                let grade = document.getElementsByName("e_grade")[0];
                let id = document.getElementsByName("l_id")[0];

                // change the value of the elements to the selected learner's information
                name.value = learnerInfo["name"];
                surname.value= learnerInfo["surname"];
                cell_num.value = learnerInfo["cell_num"];
                grade.value = learnerInfo["grade"];
                id.value = learnerInfo["id"];

                 // Add events to the form controls, so when they're hovered over, they are reenabled and vice versa
                editFormEvents(name, surname, grade, cell_num);

                // Disable the form controls
                name.disabled = true;
                surname.disabled = true;
                grade.disabled = true;
                cell_num.disabled = true;
            }
        }
    });

    function editFormEvents(name, surname, grade, cell_num) {
        name.addEventListener("pointerover", () => {
            name.disabled = false;
        });
        name.addEventListener("pointerout", () => {
            name.disabled = true;
        });
        name.addEventListener("touchstart", () => {
            name.disabled = true;
        });
        name.addEventListener("touchend", () => {
            name.disabled = false;
        });

        surname.addEventListener("pointerover", () => {
            surname.disabled = false;
        });
        surname.addEventListener("pointerout", () => {
            surname.disabled = true;
        });
        surname.addEventListener("touchend", () => {
            surname.disabled = false;
        });
        surname.addEventListener("touchstart", () => {
            surname.disabled = true;
        });

        grade.addEventListener("pointerover", () => {
            grade.disabled = false;
        });
        grade.addEventListener("pointerout", () => {
            grade.disabled = true;
        });
        grade.addEventListener("touchend", () => {
            grade.disabled = false;
        });
        grade.addEventListener("touchstart", () => {
            grade.disabled = true;
        });

        cell_num.addEventListener("pointerover", () => {
            cell_num.disabled = false;
        });
        cell_num.addEventListener("pointerout", () => {
            cell_num.disabled = true;
        });
        cell_num.addEventListener("touchend", () => {
            cell_num.disabled = false;
        });
        cell_num.addEventListener("touchstart", () => {
            cell_num.disabled = true;
        });
    }
}

function checkPhoneNum()
{
    return 0;
}