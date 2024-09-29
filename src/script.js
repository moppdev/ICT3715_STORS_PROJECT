// Script.js - JavaScript Events

// If page is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    passwordToggle();
    translateHeroTextForMobile();
    learnerHubSPAFunction();
    learnerSelect();
    checkPhoneNum();
    checkNameInputs();
    checkEmailInputs();
    blockFormPosting();
    applySPA();
    selectStyling();
    parentSPAFunction();
    adminApplySPAFunction();
    passengerListFuncs();

});

    ////// functions //////

    /// Function that essentially makes learner_hub.php and admin_learners.php a SPA (single page application), so that 
    // a parent and admin can register, delete and edit a learner all on one page
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
                subtitle.textContent = "Edit a learner's details by completing the form below.";
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

        // Making the select elements that relate to learners and parents scrollable
        function selectStyling()
        {
            const parents = document.getElementsByName("parent");
        
            parents.forEach((elem) => {
                elem.size = 10;
        
                elem.addEventListener('focus', function() {
                    this.size = 5;
                });
        
                elem.addEventListener('blur', function() {
                    this.size = 1;
                });
        
                elem.addEventListener('change', function() {
                    this.size = 1;
                    this.blur();
                });
            });
        }

    // password visibility toggle
    function passwordToggle()
    {
        // Get the toggler itself
        const togglerArray = document.getElementsByName("togglePassword");

        // If togglers exist...
        if (togglerArray)
        {
            // Initialize visible variable to check if password is visible or not
            let visible = false;
    
            togglerArray.forEach((elem) => {
                // Get the password closest to the toggler
                const currentPass = elem.closest('.mb-3').querySelector('input[type="password"]');

                // Event listener for the click event, checks status of visible and changes password visibility and icon accordingly
                elem.addEventListener("click", () => {
                    if (visible)
                    {
                        visible = false;
                        currentPass.type = "password";
                        elem.removeChild(elem.firstElementChild);
                        const openEye = document.createElement("div")
                        openEye.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"> <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/></svg>';
                        elem.appendChild(openEye);
                    }
                    else
                    {
                        visible = true;
                        currentPass.type = "text";
                        elem.removeChild(elem.firstElementChild);
                        const closedEye = document.createElement("div");
                        closedEye.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/><path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/></svg>';
                        elem.appendChild(closedEye);
                    }
                });
            })
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
                    heroText.style.transform = "translate(-50%,-180%)";
                }
                else
                {
                    clicked = true;
                    heroText.style.transform = "translate(-50%,-6%)";
                }
            });
        }
    };

    /// Function that essentially makes learner_hub.php and admin_learners.php a SPA, so that 
    // a parent and admin can register, delete and edit a learner all on one page
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
                subtitle.textContent = "Edit a learner's details by completing the form below.";
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

        if (options)
        {
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

                        // Change bgColor to White
                        name.style.backgroundColor = "white";
                        surname.style.backgroundColor = "white";
                        cell_num.style.backgroundColor = "white";
                        grade.style.backgroundColor = "white";

                    }
                }
            });
        }

        let parents;
        // get the select element where learners are selected
        const parentOptions = document.getElementsByName("selected_parent")[0];

        if (parentOptions)
            {
                    // Get the information of the learners
                fetch("../index.php?action=get_parents")
                .then(response => (response.json()))
                .then(data => (parents = data))
                .catch(error => console.log(error));
    
                // Check for when the value of options changes
                parentOptions.addEventListener("change", () => {
                    const parentInfo = parents[parentOptions.selectedIndex - 1];
                    const edit_parent = document.getElementById("edit_parent");
    
                    // if the form exists
                    if (edit_parent)
                    {
                        // if the form is not displaying
                        if (edit_parent.style.display = "none")
                        {
                            // show the form and get access to its elements
                            edit_parent.style.display = "block";
                            let name = document.getElementsByName("e_name")[0];
                            let surname = document.getElementsByName("e_surname")[0];
                            let cell_num = document.getElementsByName("e_cell_num")[0];
                            let pass = document.getElementsByName("e_password")[0];
                            let email = document.getElementsByName("e_email")[0];
                            let id = document.getElementsByName("p_id")[0];
    
                            // change the value of the elements to the selected learner's information
                            name.value = parentInfo["name"];
                            surname.value= parentInfo["surname"];
                            cell_num.value = parentInfo["cell_num"];
                            pass.value = parentInfo["password"];
                            email.value = parentInfo["email"];
                            id.value = parentInfo["id"];
    
                            // Change bgColor to White
                            name.style.backgroundColor = "white";
                            surname.style.backgroundColor = "white";
                            cell_num.style.backgroundColor = "white";
                            email.style.backgroundColor = "white";
                            pass.style.backgroundColor = "white";
    
                        }
                    }
                });
        }
    }

    // function that checks a phone number being entered and returns appropriate output
    function checkPhoneNum()
    {
        const eCellNum = document.getElementsByName("e_cell_num");
        const cellNum = document.getElementsByName("cell_num");

        eCellNum.forEach((elem) => {
            elem.addEventListener("input", () => {
                let result = phoneRegexFunction(elem.value);
                if (result)
                {
                    elem.style.backgroundColor= "white";
                }
                else
                {
                    elem.style.backgroundColor = "#FFCCCB";
                }
            })
        })

        cellNum.forEach((elem) => {
            elem.addEventListener("input", () => {
                let result = phoneRegexFunction(elem.value);
                if (result)
                {
                    elem.style.backgroundColor = "white";
                }
                else
                {
                    elem.style.backgroundColor = "#FFCCCB";
                }
            })
        })
    }

    // function that checks a name being entered and returns appropriate output
    function checkNameInputs()
    {
        const eName = document.getElementsByName("e_name")[0];
        const name = document.getElementsByName("name")[0];
        const eSurname = document.getElementsByName("e_surname")[0];
        const surname = document.getElementsByName("surname")[0];

        if (eName && eSurname && name && surname)
        {
            let elementArray = [eName, name, eSurname, surname];

            elementArray.forEach((elem) => {
                elem.addEventListener("input", () => {
                    let result = nameRegexFunction(elem.value);
                    if (result)
                    {
                        elem.style.backgroundColor= "white";
                    }
                    else
                    {
                        elem.style.backgroundColor = "#FFCCCB";
                    }
                })
            })
        }
    }

        // function that checks an email being entered and returns appropriate output
        function checkEmailInputs()
        {
            const eEmail = document.getElementsByName("e_email")[0];
            const email = document.getElementsByName("email")[0];

            if (eEmail && email)
            {
                let elementArray = [eEmail, email];
    
                elementArray.forEach((elem) => {
                    elem.addEventListener("input", () => {
                        let result = emailRegexFunction(elem.value);
                        if (result)
                        {
                            elem.style.backgroundColor= "white";
                        }
                        else
                        {
                            elem.style.backgroundColor = "#FFCCCB";
                        }
                    })
                })
            }
        }
    

    // Function that actually checks a SA phone number via RegEx
    function phoneRegexFunction(cell_num)
    {
        const regex = /^0[6-9]\d{8}$/;
        return regex.test(cell_num);
    }

    // Function that actually checks text like names, etc via RegEx
    function nameRegexFunction(name)
    {
        const regex = /^[A-Za-z]+$/;
        return regex.test(name);
    }

    // Function that actually checks emails via RegEx
    function emailRegexFunction(email)
    {
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regex.test(email);
    }

    // Function that will check if inputs in forms are correct, if not the submit button will be disabled
    function blockFormPosting()
    {
        // Get all relevant elements
        const eName = document.getElementsByName("e_name")[0];
        const name = document.getElementsByName("name")[0];
        const eSurname = document.getElementsByName("e_surname")[0];
        const surname = document.getElementsByName("surname")[0];
        const eCellNum = document.getElementsByName("e_cell_num")[0];
        const cellNum = document.getElementsByName("cell_num")[0];
        const eGrade = document.getElementsByName("e_grade")[0];
        const grade = document.getElementsByName("grade")[0];
        const selectedLearner = document.getElementsByName("selected_learner")[1];
        const selectedRemoveParent = document.getElementsByName("selected_parent")[1];
        const eEmail = document.getElementsByName("e_email")[0];
        const email = document.getElementsByName("email")[0];
        const ePass = document.getElementsByName("e_password")[0];
        const pass = document.getElementsByName("password")[0];

        // Get the relevant submit buttons
        const editSubmit = document.getElementsByName("editBtn")[0];
        const newSubmit = document.getElementsByName("registerBtn")[0];
        const removeSubmit = document.getElementsByName("removeBtn")[0];


        if (editSubmit && newSubmit && removeSubmit)
        {
                // for simplicity put all element variables in respective arrays
                let editArray = [eName, eSurname, eGrade, eCellNum, eEmail, ePass];
                let registerArray = [name, surname, grade, cellNum, email, pass];
                let removeArray = [selectedLearner, selectedRemoveParent];

                // disable the submit buttons
                editSubmit.disabled = false;
                newSubmit.disabled = true;
                removeSubmit.disabled = true;

                if (editArray)
                {
                         // Loop through the array and add an event listener to each element
                        editArray.forEach((elem) => {
                            if (elem)
                            {
                                elem.addEventListener("input", () => {
                                        if (eName && eSurname && eCellNum && eGrade)
                                        {
                                            // Check if the background color of all register inputs are red (signifies error) or not
                                            if (eName.style.backgroundColor == "white" && eSurname.style.backgroundColor == "white" 
                                                && eCellNum.style.backgroundColor == "white" && eGrade.value != "")
                                            {
                                                editSubmit.disabled = false;
                                            }
                                            else
                                            {
                                                editSubmit.disabled = true;
                                            }
                                        }
                                        else if (eName && eSurname && eCellNum && ePass && eEmail)
                                        {
                                            // Check if the background color of all register inputs are red (signifies error) or not
                                            if (eName.style.backgroundColor == "white" && eSurname.style.backgroundColor == "white" 
                                                && eCellNum.style.backgroundColor == "white" && eEmail.style.backgroundColor == "white")
                                            {
                                                console.log("MARCO");
                                                editSubmit.disabled = false;
                                            }
                                            else
                                            {
                                                editSubmit.disabled = true;
                                            }
                                        }
                                    }
                                );
                            }
                    });
                }

                if (removeArray)
                {
                    removeArray.forEach((elem) => {
                            if (elem)
                            {
                                elem.addEventListener(("input"), () => {
        
                                    if (selectedLearner)
                                    {
                                            // Check if a learner is selected to be removed
                                            if (selectedLearner.value != "")
                                            {
                                                removeSubmit.disabled = false;
                                            }
                                    }

                                    if (selectedRemoveParent)
                                        {
                                                // Check if a learner is selected to be removed
                                                if (selectedRemoveParent.value != "")
                                                {
                                                    removeSubmit.disabled = false;
                                                }
                                        }
                                });
                            }
                        })
                }

                if (registerArray)
                {
                    registerArray.forEach((elem) => {
                        if (elem)
                        {
                            elem.addEventListener("input", () => {
                                if (name && surname && cellNum && grade)
                                    {
                                            // Check if the background color of all edit inputs are red (signifies error) or not
                                            if (name.style.backgroundColor == "white" && surname.style.backgroundColor == "white" 
                                                && cellNum.style.backgroundColor == "white" && grade.value != "")
                                            {
                                                newSubmit.disabled = false;
                                            }
                                            else
                                            {
                                                newSubmit.disabled = true;
                                            }
                                    }
                                    if (name && surname && cellNum && email && pass)
                                    {
                                            // Check if the background color of all edit inputs are red (signifies error) or not
                                            if (name.style.backgroundColor == "white" && surname.style.backgroundColor == "white" 
                                                && cellNum.style.backgroundColor == "white" && email.style.backgroundColor == "white" &&
                                            pass.value != "")
                                            {
                                                newSubmit.disabled = false;
                                            }
                                            else
                                            {
                                                newSubmit.disabled = true;
                                            }
                                    }
                            })
                        }
                    })
                }
        };
    }

    // function that will make applytransport.php an SPA
    function applySPA()
    {
        // Get the div that houses the application form, the hidden l_id, the heading in the form
        // And the two cancel and apply buttons
        const applyDiv = document.getElementById("apply_learner_div");

        if (applyDiv)
        {
            applyDiv.style.display = "none";
            const learnerID = document.getElementsByName("l_id")[0];
            const applyHeading = document.getElementsByName("apply_heading")[0];

            const cancelBtns = document.getElementsByName("cancelBtn");
            const applyBtns = document.getElementsByName("applyFormBtn");

            // if cancelBtns are defined, add an event listener
            if (cancelBtns)
            {
                // when clicked, send a fetch GET to index.php to delete the application
                if (cancelBtns) {
                    cancelBtns.forEach((elem) => {
                        elem.addEventListener("pointerdown", () => {
                            fetch(`../index.php?action=cancel_app&id=${elem.value}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // alert the user
                                        alert("SUCCESS: APPLICATION CANCELLED")

                                        // Switch button from "Cancel Application" to "Apply For Transport"
                                        elem.classList.remove("btn-danger");
                                        elem.classList.add("btn-primary");
                                        elem.textContent = "Apply For Transport";
                                        elem.name = "applyFormBtn"; // Switch to applyFormBtn
                                        
                                        // Re-attach event listener to work as an apply button
                                        elem.addEventListener("pointerdown", () => {
                                            applyDiv.style.display = "block";
                                            const currentRow = elem.closest('tr');
                                            const learnerName = currentRow.cells[0].textContent;
                                            applyHeading.textContent = `Apply For ${learnerName}`;
                                            learnerID.value = elem.value;
                                        });
                                    }
                                })
                                .catch(error => console.log(error));
                        });
                    });
                }
            }

            // if applyBtns are defined, add an event listener
            if (applyBtns) {
                applyBtns.forEach((elem) => {
                    elem.addEventListener("pointerdown", () => {
                        applyDiv.style.display = "block";
                        const currentRow = elem.closest('tr');
                        const learnerName = currentRow.cells[0].textContent;
                        applyHeading.textContent = `Apply For ${learnerName}`;
                        learnerID.value = elem.value;
                    })}
            );

            // Get the elements in the application form
            const pickup = document.getElementsByName("pickup");
            const dropoff = document.getElementsByName("dropoff");
            const applyBtn = document.querySelector("button[name=applyBtn]");

            // Add event listeners that listen for a change in value on the pickup selects
            pickup.forEach((elem) => {
                elem.addEventListener("input", () => {
                    // Compare the number in the zeroth index in the pickup's value to the one in dropoff
                    // If equal, the selected options in both are on the same route and the submit button should be enabled
                    // Otherwise it should be disabled
                    let otherVal = (document.querySelector("select[name=dropoff]")).value.substring(0,1);
                    let curVal = elem.value.substring(0,1);
                    if (curVal != otherVal)
                    {
                        applyBtn.disabled = true;
                    }
                    else
                    {
                        applyBtn.disabled = false;
                    }
                });
            })

            // Add event listeners that listen for a change in value on the dropoff selects
            dropoff.forEach((elem) => {
                elem.addEventListener("input", () => {
                    // Compare the number in the zeroth index in the dropoff's value to the one in pickup
                    // If equal, the selected options in both are on the same route and the submit button should be enabled
                    // Otherwise it should be disabled
                    let otherVal = (document.querySelector("select[name=pickup]")).value.substring(0,1);
                    let curVal = elem.value.substring(0,1);
                    if (curVal != otherVal)
                    {
                        applyBtn.disabled = true;
                    }
                    else
                    {
                        applyBtn.disabled = false;
                    }
                });
            })
        }
    }
}

    /// Function that essentially makes admin_learners.php a SPA, so that 
    // an admin can register, delete and edit a parent all on one page
    function parentSPAFunction()
    {
        // Get the buttons used on the page
        const registerBtn = document.getElementById("registerParentBtn");
        const editBtn = document.getElementById("editParentBtn");
        const removeBtn = document.getElementById("removeParentBtn");

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
                title.textContent = "Register a Parent";
                registerBtn.className = "btn btn-primary";
                editBtn.className = "btn btn-secondary";
                removeBtn.className = "btn btn-secondary";
                register.style.display = "block";
                edit.style.display = "none";
                remove.style.display = "none";
                subtitle.textContent = "Fill in the form below to create a parent.";
            });
            editBtn.addEventListener("click", () => {
                title.textContent = "Edit a Parent's Details";
                registerBtn.className = "btn btn-secondary";
                editBtn.className = "btn btn-primary";
                removeBtn.className = "btn btn-secondary";
                register.style.display = "none";
                edit.style.display = "block";
                remove.style.display = "none";
                subtitle.textContent = "Edit a parent's details by completing the form below.";
            });
            removeBtn.addEventListener("click", () => {
                title.textContent = "Remove a Parent";
                registerBtn.className = "btn btn-secondary";
                editBtn.className = "btn btn-secondary";
                removeBtn.className = "btn btn-primary";
                register.style.display = "none";
                edit.style.display = "none";
                remove.style.display = "block";
                subtitle.textContent = "Remove a parent and their related information from the system by completing the form below.";
            });
        }
    }

    // Function that makes admin_lists an SPA
    function adminApplySPAFunction()
    {
         // Get the buttons used on the page
         const applyBtn = document.getElementById("applyLearnBtn");
         const waitBtn = document.getElementById("waitingBtn");
         const passBtn = document.getElementById("passBtn");

         // Fragments of the page
         const applyLearner = document.getElementById("applyLearner");
         const waitingList = document.getElementById("waitingList");
         const passList = document.getElementById("passengerList");
 
         // Check if buttons exist
         if (applyBtn && waitBtn && passBtn)
         {
             // Other elements like the title and sections themselves
             const title = document.getElementById("title");
             const subtitle = document.getElementById("subtitle");
 
             // Initial display
             applyLearner.style.display = "block";
             waitingList.style.display = "none";
             passList.style.display = "none";
 
             // Add onclick event listeners for each button
             applyBtn.addEventListener("click", () => {
                 title.textContent = "Apply For A Learner";
                 applyBtn.className = "btn btn-primary";
                 waitBtn.className = "btn btn-secondary";
                 passBtn.className = "btn btn-secondary";
                 applyLearner.style.display = "block";
                 waitingList.style.display = "none";
                 passList.style.display = "none";
                 subtitle.textContent = "Apply for a learner below. NB: Please select points that are on the same route. E.g. Select 1A and 1B of Rooihuiskraal.";
             });
             waitBtn.addEventListener("click", () => {
                 title.textContent = "Waiting Lists";
                 applyBtn.className = "btn btn-secondary";
                 waitBtn.className = "btn btn-primary";
                 passBtn.className = "btn btn-secondary";
                 applyLearner.style.display = "none";
                 waitingList.style.display = "block";
                 passList.style.display = "none";
                 subtitle.textContent = "Manage the waiting list below.";
             });
             passBtn.addEventListener("click", () => {
                 title.textContent = "Passenger Lists";
                 applyBtn.className = "btn btn-secondary";
                 waitBtn.className = "btn btn-secondary";
                 passBtn.className = "btn btn-primary";
                 applyLearner.style.display = "none";
                 waitingList.style.display = "none";
                 passList.style.display = "block";
                 subtitle.textContent = "Manage the passenger lists below";
             });
         }

         //// The same as below but for parents in "apply for a learner" ////
         // Allow the admin to search for a specific student to apply for
         let searcherTwo = document.getElementsByName('searcher')[0];
         let parentDropdown = document.getElementById('parentDropdown');
         let parent = document.getElementById("parent");

         if (parentDropdown)
        {
            // Add an input event listener to the searcher, convert the input to lowercase and search amongst the options
            searcherTwo.addEventListener('input', function() {
                const searchTerm = searcherTwo.value.toLowerCase();
                const options = parentDropdown.getElementsByClassName('dropdown-item');
            
                let hasVisibleOptions = false;
            
                for (let i = 0; i < options.length; i++) {
                    const optionText = options[i].textContent.toLowerCase();
                    if (optionText.includes(searchTerm)) {
                        options[i].style.display = 'block';
                        hasVisibleOptions = true;
                    } else {
                        options[i].style.display = 'none';
                    }
                }
            
                // Toggle the dropdown visibility based on matching options
                if (hasVisibleOptions) {
                    parentDropdown.style.display = 'block';
                } else {
                    parentDropdown.style.display = 'none';
                }
            });
            
            // Add event listener to allow the admin to select an option
            parentDropdown.addEventListener('click', (e) => {
                if (e.target.classList.contains('dropdown-item')) {
                    searcherTwo.value = e.target.textContent.trim();
                    parent.value = parseInt(e.target.dataset.value);
                    parentDropdown.style.display = 'none';
                }
            });
        }

            // Allow the admin to search for a specific student to apply for
         let searcher = document.getElementsByName('searcher')[0];
         let dropdown = document.getElementById('learnerDropdown');
         let learn_id = document.getElementById("l_id");

         if (dropdown && searcher)
        {
            // Add an input event listener to the searcher, convert the input to lowercase and search amongst the options
            searcher.addEventListener('input', function() {
                const searchTerm = searcher.value.toLowerCase();
                const options = dropdown.getElementsByClassName('dropdown-item');
            
                let hasVisibleOptions = false;
            
                for (let i = 0; i < options.length; i++) {
                    const optionText = options[i].textContent.toLowerCase();
                    if (optionText.includes(searchTerm)) {
                        options[i].style.display = 'block';
                        hasVisibleOptions = true;
                    } else {
                        options[i].style.display = 'none';
                    }
                }
            
                // Toggle the dropdown visibility based on matching options
                if (hasVisibleOptions) {
                    dropdown.style.display = 'block';
                } else {
                    dropdown.style.display = 'none';
                }
            });
            
            // Add event listener to allow the admin to select an option
            dropdown.addEventListener('click', (e) => {
                if (e.target.classList.contains('dropdown-item')) {
                    searcher.value = e.target.textContent.trim();
                    learn_id.value = parseInt(e.target.dataset.value);
                    dropdown.style.display = 'none';
                }
            });
        }

            // Get the elements in the application form
            const applyLearnerBtn = document.getElementsByName("applyBtn")[0];

            const pickup = document.getElementsByName("pickup")[0];
            const dropoff = document.getElementsByName("dropoff")[0];

            if (pickup && dropoff && applyLearnerBtn)
            {
                applyLearnerBtn.disabled = true;

                 // Add event listeners that listen for a change in value on the pickup selects
                pickup.addEventListener("input", () => {
                    // Compare the number in the zeroth index in the pickup's value to the one in dropoff
                    // If equal, the selected options in both are on the same route and the submit button should be enabled
                    // Otherwise it should be disabled
                    let otherVal = (document.querySelector("select[name=dropoff]")).value.substring(0,1);
                    let curVal = pickup.value.substring(0,1);
                    if ((curVal === otherVal))
                    {
                        applyLearnerBtn.disabled = false;
                    }
                });

            // Add event listeners that listen for a change in value on the dropoff selects
            dropoff.addEventListener("input", () => {
                    // Compare the number in the zeroth index in the dropoff's value to the one in pickup
                    // If equal, the selected options in both are on the same route and the submit button should be enabled
                    // Otherwise it should be disabled
                    let otherVal = (document.querySelector("select[name=pickup]")).value.substring(0,1);
                    let curVal = pickup.value.substring(0,1);
                    console.log(! (curVal != otherVal));
                    if ((curVal === otherVal))
                    {
                        applyLearnerBtn.disabled = false;
                    }
                });

                const cancelBtns = document.getElementsByName("cancelBtn");

                // if cancelBtns are defined, add an event listener
                if (cancelBtns)
                {
                    // when clicked, send a fetch GET to index.php to delete the application
                    if (cancelBtns) {
                        cancelBtns.forEach((elem) => {
                            elem.addEventListener("pointerdown", () => {
                                fetch(`../index.php?action=cancel_app_admin&id=${elem.value}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        window.location.reload();
                                    })
                                    .catch(error => console.log(error));
                            });
                        });
                    }
                }
            }
    
            // Passenger list functions
            passengerListFuncs();

            // Waiting List functions
            waitListFuncs();
    }
    
    // Function that controls the events on the waiting list on an admin's page
    function waitListFuncs()
    {
        const cancel = document.getElementsByName("cancelAppBtn");
        const move = document.getElementsByName("moveBtn");

        if (cancel)
        {
            cancel.forEach((elem) => {
                elem.addEventListener("pointerdown", () => {
                    fetch(`../index.php?action=cancel_app_admin&id=${elem.value}`)
                        .then(response => response.json())
                        .then(data => {
                            window.location.reload();
                        })
                        .catch(error => console.log(error));
                });
            })
        }

        if (move)
        {
            move.forEach((elem) => {
                elem.addEventListener("pointerdown", () => {
                    console.log("GOOD MORNING");
                    // fetch(`../index.php?action=move_to_trips&id=${elem.value}`)
                    // .then(response => {
                    //     console.log(response.text());
                    // })
                    // .then(data => {
                    //     if (data["success"])
                    //     {
                    //         window.location.reload();
                    //     }
                    //     else
                    //     {
                    //         alert(data["reason"]);
                    //     }
                    // })
                    // .catch(error => console.log(error));
                });
            });
        }
    }

    // Function that moves a learner to the passenger list
    function passengerListFuncs()
    {
        // get the buttons from the passenger list
        const removeBtn = document.getElementsByName("cancelPassBtn");

        if (removeBtn)
        {
            removeBtn.forEach((elem) => {
                
                elem.addEventListener("pointerdown", () => {
                    fetch(`../index.php?action=remove_trip&id=${elem.value}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data["success"])
                        {
                            window.location.reload();
                        }
                        else
                        {
                            alert("Couldn't remove trip.");
                        }
                    })
                    .catch(error => console.log(error));
                });
            });
        }
    }