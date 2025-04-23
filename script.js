const form = document.getElementById('form');
const submittedData = document.getElementById('submitted-data');

function storeFormData() {
    const user = {
        name: form.name.value,
        email: form.email.value,
        date: form.date.value,
        phone: form.phone.value,
        satisfaction: form.satisfaction.value,
        message: form.message.value
    };
    
   // console.log(user);

    // Displaying the submitted data
    submittedData.innerHTML = `
            <h2>Submitted Feedback:</h2>
            <p><strong>Name:</strong> ${user.name}</p>
            <p><strong>Email:</strong> ${user.email}</p>
            <p><strong>Date of Birth:</strong> ${user.date}</p>
            <p><strong>Phone:</strong> ${user.phone}</p>
            <p><strong>Satisfaction Level:</strong> ${user.satisfaction}</p>
            <p><strong>Message:</strong> ${user.message}</p>`;
}  

function processFormData(event) {
    event.preventDefault();

    // form validity
    if (!form.checkValidity()) {
        return;
    }

     // --- SERVER-SIDE LIKE VALIDATIONS ---
    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const phone = form.phone.value.trim();
    const message = form.message.value.trim();

    // the input elements
    const nameInput = form.name;   
    // the error divs
    const nameError = document.getElementById('name-error'); 
    


    if (name.length < 3) {
        // alert("Name must be at least 3 characters long.");
       
        nameError.textContent = "Name must be at least 3 characters long.";
        nameInput.style.borderColor = "red";
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert('wrong email patterm');
        return;
    }

    const phonePattern = /^[0-9]{10,13}$/;
    if (!phonePattern.test(phone)) {
        alert("Phone must be 10 to 13 digits.");
        return;
    }

    if (message.split(' ').length < 5) {
        alert("Feedback message must be at least 5 words.");
        return;
    }


    // fake loading spinner w/ 2sec wait time
        submittedData.style.display = "none";
        loading.style.display = "flex";
        
        setTimeout(() => {
        loading.style.display = "none"; 
        submittedData.style.display = "block";

        nameError.textContent = "";
        nameInput.style.borderColor = "green";          
            
        storeFormData();
        }, 2000);
}
