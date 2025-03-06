// Load form data from LocalStorage on page load
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('personal-info');
    const formData = JSON.parse(localStorage.getItem('formData')) || {};

    for (const key in formData) {
        if (formData.hasOwnProperty(key) && form[key]) {
            form[key].value = formData[key];
        }
    }
});

// Save form data to LocalStorage on form submit
document.getElementById('personal-info').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = {};
    const form = event.target;

    for (let i = 0; i < form.elements.length; i++) {
        const element = form.elements[i];
        if (element.name) {
            formData[element.name] = element.value;
        }
    }

    localStorage.setItem('formData', JSON.stringify(formData));
});
