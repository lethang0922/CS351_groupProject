function validateReservation() {
  const form = document.getElementById("reservationForm");
  const name = form.elements["Name"].value;
  const guests = parseInt(form.elements["Guests"].value, 10);
  const dateTime = new Date(form.elements["date"].value);
  const now = new Date();

  // Check if the number of guests is valid
  if (isNaN(guests) || guests < 1) {
    alert("Number of guests must be a positive integer.");
    return;
  }

  // Check if the booking time is at least 2 hours from now
  const minimumTime = new Date(now.getTime() + 2 * 60 * 60 * 1000);
  if (dateTime <= now || dateTime < minimumTime) {
    alert("Booking time must be at least 2 hours from now.");
    return;
  }

  // Your existing form submission logic goes here
  alert(`Reservation confirmed for ${name} and ${guests} guests at ${dateTime.toLocaleString()}`);
  form.submit();
}

//press Enter for Send Request button
$(document).ready(function() {
  $('#reservationForm input').keypress(function(event) {
    if (event.which === 13) { // Check if the Enter key (key code 13) is pressed
      event.preventDefault(); // Prevent default form submission behavior
      $('#reservationForm').submit(); 
    }
  });
});
