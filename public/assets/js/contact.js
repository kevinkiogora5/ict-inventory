document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            // Get form elements
            const firstName = document.getElementById('first_name');
            const lastName = document.getElementById('last_name');
            const email = document.getElementById('email');
            const inquiryType = document.getElementById('inquiry_type');
            const message = document.getElementById('message');
            
            let isValid = true;
            let errorMessages = [];
            
            // Validate first name
            if (!firstName.value.trim()) {
                isValid = false;
                errorMessages.push('First name is required');
                firstName.classList.add('border-red-500', 'bg-red-50');
            } else {
                firstName.classList.remove('border-red-500', 'bg-red-50');
            }
            
            // Validate last name
            if (!lastName.value.trim()) {
                isValid = false;
                errorMessages.push('Last name is required');
                lastName.classList.add('border-red-500', 'bg-red-50');
            } else {
                lastName.classList.remove('border-red-500', 'bg-red-50');
            }
            
            // Validate email
            if (!email.value.trim()) {
                isValid = false;
                errorMessages.push('Email is required');
                email.classList.add('border-red-500', 'bg-red-50');
            } else if (!isValidEmail(email.value.trim())) {
                isValid = false;
                errorMessages.push('Please enter a valid email address');
                email.classList.add('border-red-500', 'bg-red-50');
            } else {
                email.classList.remove('border-red-500', 'bg-red-50');
            }
            
            // Validate inquiry type
            if (!inquiryType.value) {
                isValid = false;
                errorMessages.push('Please select an inquiry type');
                inquiryType.classList.add('border-red-500', 'bg-red-50');
            } else {
                inquiryType.classList.remove('border-red-500', 'bg-red-50');
            }
            
            // Validate message
            if (!message.value.trim()) {
                isValid = false;
                errorMessages.push('Message is required');
                message.classList.add('border-red-500', 'bg-red-50');
            } else {
                message.classList.remove('border-red-500', 'bg-red-50');
            }
            
            // If form is not valid, prevent submission and show errors
            if (!isValid) {
                event.preventDefault();
                
                // Check if error container already exists
                let errorContainer = document.querySelector('.bg-red-50');
                
                if (!errorContainer) {
                    // Create error container
                    errorContainer = document.createElement('div');
                    errorContainer.className = 'bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded';
                    
                    // Create error list
                    const errorList = document.createElement('ul');
                    errorList.className = 'list-disc pl-5 text-red-700';
                    
                    // Append error list to container
                    errorContainer.appendChild(errorList);
                    
                    // Insert error container before the form
                    contactForm.parentNode.insertBefore(errorContainer, contactForm);
                }
                
                // Get or create error list
                let errorList = errorContainer.querySelector('ul');
                
                // Clear previous errors
                errorList.innerHTML = '';
                
                // Add new error messages
                errorMessages.forEach(function(message) {
                    const errorItem = document.createElement('li');
                    errorItem.textContent = message;
                    errorList.appendChild(errorItem);
                });
                
                // Scroll to error container
                errorContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }
    
    // Email validation helper function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});