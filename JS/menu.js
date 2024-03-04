document.addEventListener("DOMContentLoaded", function () {
  const orderButton = document.getElementById('orderButton');
  const submitOrderButton = document.getElementById('submitOrderButton');
  const orderAnnouncements = document.getElementById('orderAnnouncements');
  const thankYouMessage = document.getElementById('thankYouMessage');

  // Function to handle clicking on h3 items
  function handleItemClick(itemName) {
    // Create a new div for the item announcement
    const itemAnnouncement = document.createElement('div');
    itemAnnouncement.textContent = itemName;

    // Create a button to remove the item announcement
    const removeButton = document.createElement('button');
    removeButton.textContent = 'X';
    removeButton.addEventListener('click', function () {
      itemAnnouncement.remove();
      checkSubmitButtonVisibility();
    });

    // Append the item announcement and remove button to the order announcements container
    orderAnnouncements.appendChild(itemAnnouncement);
    itemAnnouncement.appendChild(removeButton);

    // Show the thank you message if there are items in the order
    thankYouMessage.style.display = 'block';

    // Check if the Submit Order button should be visible
    checkSubmitButtonVisibility();
  }

  // Function to check if the Submit Order button should be visible
  function checkSubmitButtonVisibility() {
    submitOrderButton.style.display = orderAnnouncements.children.length > 0 ? 'block' : 'none';
  }

  // Attach click event listener to the Order ToGo button
  orderButton.addEventListener('click', function () {
    // Display a confirmation message for the order
    alert("Are you sure you want to place this order?");
  });

  // Attach click event listeners to all h3 elements
  const h3Elements = document.querySelectorAll('.menu-item h3');
  h3Elements.forEach(function (h3) {
    // Check if an event listener is already attached to the element
    if (!h3.hasAttribute('data-clicked')) {
      h3.setAttribute('data-clicked', 'true');
      h3.addEventListener('click', function () {
        const itemName = h3.textContent.trim();
        // Handle the item click
        handleItemClick(itemName);
      });
    }
  });
});
