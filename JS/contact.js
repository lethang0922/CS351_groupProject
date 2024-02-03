document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('.contact-form');

  form.addEventListener('submit', function (event) {
    const title = form.querySelector('#title');
    const email = form.querySelector('#email');
    const message = form.querySelector('#message');

    if (title.value === '' || email.value === '' || message.value === '') {
      alert('Please fill in all the required fields.');
      event.preventDefault();
    }
  });
  
});
function showSuccessAlert() {
  alert('Your email has been sent successfully! We will get back to you soon.');
}