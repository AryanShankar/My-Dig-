

const stateCityMap = {
  "Maharashtra": ["Mumbai", "Pune", "Nagpur"],
  "Tamil Nadu": ["Chennai", "Trichy", "Coimbatore", "Madurai"],
  "Karnataka": ["Bangalore", "Mysore", "Mangalore"],
  "Andhra-Pradesh": ["Vizag", "Amravati"],
  "Rajashthan": ["Jaipur", "Udaipur", "Ajmer"]
};


const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const phoneInput = document.getElementById('phone');

const stateDropdown = document.getElementById("state");
const cityDropdown = document.getElementById("city");

const pincodeInput = document.getElementById('pincode');

const submitBtn = document.getElementById('submitBtn');



  // window.onload = () => {}
  nameInput.onpaste = e => e.preventDefault();
  phoneInput.onpaste = e => e.preventDefault();
  pincodeInput.onpaste = e => e.preventDefault();
  emailInput.onpaste = e => e.preventDefault();






// NAME VALIDATION
nameInput.addEventListener('keypress', function(event) {
  // Get the value of the key pressed
  const key = event.key;
  console.log(event);
  //console.log(typeof(event));  prints the object
  //console.log(event); object

  // regular expression to allow only alphabets and - ' 
  const regex = /^[a-zA-Z'-]+$/;

  // Test if the key pressed matches the regular expression
  if (!regex.test(key)) {
      // Prevent default behavior (input of the key)
      event.preventDefault();
  }
});



// MAIL VALIDATION
// // The blur event occurs when the user leaves the email input field.
// emailInput.addEventListener('blur', function() {
//     const email = emailInput.value.trim();

//     // Regular expression for email validation
//     const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

//     // Test if the email matches the regular expression
//     if (!emailRegex.test(email)) {
//         alert('Please enter a valid email address.');
//         emailInput.value='';
//         // emailInput.focus();
//     }
// });



// PHONE VALIDATION
phoneInput.addEventListener('keypress', function(event) {
  let phoneValue = phoneInput.value.trim();
  
  // Get the value of the key pressed
  const key = event.key;

  // const regex = /^[6-9]+$/;

  // Check if the key pressed is a number and if the length of the input is less than 10
  if (isNaN(key) || phoneInput.value.length >= 10 || !/^([6-9]\d{0,9})?$/.test(phoneValue)) {
      // Prevent default behavior (input of the key)
      event.preventDefault();
  }
});



// PINCODE VALIDATION
pincodeInput.addEventListener("keypress", function(event) {
  // Get the current value of the input field
  let pincodeValue = pincodeInput.value;

  // Check if the length of the input value is greater than 6
  if (pincodeValue.length > 6 || !/^([6-7]\d{0,9})?$/.test(pincodeValue)) {
      // If the length is greater than 6, prevent the default behavior of the event (which here is a keypress)
      event.preventDefault();
  }
});









Object.keys(stateCityMap).forEach(state => {
  const option = new Option(state, state);
  stateDropdown.add(option);
});




Object.values(stateCityMap).forEach(cities => {
  cities.forEach(city => {
    const option = new Option(city, city);
    cityDropdown.add(option);
  });
});

function updateCityDropdown() {
  const selectedState = stateDropdown.value;
  const cityDropdown = document.getElementById("city");
  cityDropdown.innerHTML = "<option value='' disabled selected>Select City</option>"; //disabled

  if (selectedState in stateCityMap) {
    stateCityMap[selectedState].forEach(city => {
      const option = new Option(city, city);
      cityDropdown.add(option);
    });
  }
}

function updateStateDropdown() {
  const selectedCity = cityDropdown.value;
  let selectedState = "";
  for (const state in stateCityMap) {
    if (stateCityMap[state].includes(selectedCity)) {
      selectedState = state;
      break;
    }
  }
  stateDropdown.value = selectedState;
}








// function checkFields() {
//   if (nameInput.value.trim() !== '' && emailInput.value.trim() !== '' && phoneInput.value.trim() !== '' && stateDropdown.value !== '' && cityDropdown.value !== '' && pincodeInput.value.trim() !== '') {
//     submitBtn.classList.add('enabled');
//     submitBtn.disabled = false;
//   } else {
//     submitBtn.classList.remove('enabled');
//     submitBtn.disabled = true;
//   }
// }

function checkFields() {
  const inputs = [nameInput, emailInput, phoneInput, stateDropdown, cityDropdown, pincodeInput];

  const allInputsFilled = inputs.every(input => input.value.trim() !== ''); //check what every does and returns

  // Enable or disable the submit button based on validation result
  if (allInputsFilled) {
    submitBtn.classList.add('enabled');
    submitBtn.disabled = false;
  } else {
    submitBtn.classList.remove('enabled');
    submitBtn.disabled = true;
  }
}



// nameInput.addEventListener('input', checkFields);
// emailInput.addEventListener('input', checkFields);
// phoneInput.addEventListener('number', checkFields);
// pincodeInput.addEventListner('number', checkFields)








submitBtn.addEventListener('mouseover', function() {
    // console.log(event);
    checkFields();

    const formElements = document.querySelectorAll('#userInfoForm input, #userInfoForm select');
    let fieldsToFill = [];

    
    // if (nameInput.value.trim() === '') {
    //     fieldsToFill.push('Name');
    // }
    // if (emailInput.value.trim() === '') {
    //     fieldsToFill.push('Email');
    // }
    // if (phoneInput.value.trim() === '') {
    //     fieldsToFill.push('Phone');
    // }
    // if (stateDropdown.value === '') {
    //   fieldsToFill.push('State');
    // }
    // if (cityDropdown.value === '') {
    //   fieldsToFill.push('City');
    // }
    // if (pincodeInput.value === ''){
    //   fieldsToFill.push('Pincode');
    // }
    // find way to get names of all forms elements and do it using for loop in one go instead of typing all elements one by one



    // Iterate through each form element
    formElements.forEach(element => {
      // Check if the element is empty or not selected
      if (element.value.trim() === '' || (element.tagName === 'SELECT' && element.value === '')) {
          fieldsToFill.push(element.id);
      }
    });

    if (fieldsToFill.length > 0) {
        alert("Please fill in the following fields: " + fieldsToFill.join(', '));
    }
});









submitBtn.addEventListener('click', function() {
  if (submitBtn.classList.contains('enabled')) {

    const nameValue = nameInput.value.trim();
    let emailValue = emailInput.value.trim();
    let phoneValue = phoneInput.value.trim();
    const stateValue = stateDropdown.value;
    const cityValue = cityDropdown.value;
    let pincodeValue = pincodeInput.value.trim();


    //email validation
    const emailRegex = /^([a-zA-Z0-9\._]+)@([a-zA-Z0-9]+)\.([a-z]{2,})$/;
    
    // Test if the email matches the regular expression
    if (!emailRegex.test(emailValue)) {
        // console.log(emailValue);
        emailValue = "Email entered is invalid! Enter correct Email";
        // console.log('kya re');
    }
    else{
      emailValue = emailInput.value.trim();
       console.log('correct email vro');
    }


    // PHONE VALIDATION AFTER SUBMIT
    // phoneValue = phoneValue.replace(/\D/g, '');

    // // Limit the phone number to 10 digits
    // if (phone.length > 10) {
    //     phone = phone.slice(0, 10);
    // }

    // // Update the value of the phone input
    // phoneInput.value = phoneValue;

    



    // const displayMessage = `
    // Name: ${nameValue}
    // Email: ${emailValue}
    // Phone: ${phoneValue}
    // `;

    //alert mai info print
    const alrtMessage = 'Name: ' + nameValue + '\n' + 'Email: ' + emailValue + ' \n' + 'Phone: ' + phoneValue + '\n' + 'State: ' + stateValue + '\n' + 'City: ' + cityValue + '\n' + 'Pincode: ' + pincodeValue;

    //info print on webpage
    const displayMessage = '<strong>Name:</strong> ' + nameValue + '<br>' + 
    '<strong>Email:</strong> ' + emailValue + '<br>' + 
    '<strong>Phone:</strong> ' + phoneValue + '<br>' + 
    '<strong>State:</strong> ' + stateValue + '<br>' + 
    '<strong>City:</strong> ' + cityValue + '<br>' +
    '<strong>Pincode:</strong> ' + pincodeValue;

    document.getElementById('formValues').innerHTML = displayMessage;


    // nameInput.value = '';
    // emailInput.value = '';
    // phoneInput.value = '';
    // stateDropdown.value = '';
    // cityDropdown.value = '';
    // pincodeInput.value = ''';
    document.getElementById('userInfoForm').reset(); //reset all fields when form submit



    alert("Form submitted successfully!\n" + alrtMessage);
  } else {
    alert("Please fill in all fields before submitting.");
  }
});