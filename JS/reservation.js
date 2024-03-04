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

  // Check if the booking time is at least 30 minutes from now
  const currentDateTime = new Date(now.getTime() + 30 * 60 * 1000); // Add 30 minutes to the current time

  // Set the value of the datetime-local input field to the current time plus 30 minutes
  document.getElementById("dateTimeInput").value = currentDateTime.toISOString().slice(0, 16); // Format: YYYY-MM-DDTHH:mm

  // Check if the selected time is at least 30 minutes from the current time
  if (dateTime <= currentDateTime) {
    alert("Booking time must be at least 30 minutes from now.");
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
