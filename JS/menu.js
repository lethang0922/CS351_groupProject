document.addEventListener("DOMContentLoaded", function () {
  const menuItems = document.querySelectorAll('.menu-item h3');

  menuItems.forEach(item => {
    item.addEventListener('click', function() {
      const itemName = item.textContent.trim();
      const itemPrice = getItemPrice(itemName);
      addToOrder(itemName, itemPrice);
      confirmOrder(itemName);
    });
  });

  function getItemPrice(itemName) {
    const itemPrices = {
      'Buffalo Wings': 12.00,
      'Mozzarella Sticks': 9.00,
      // Add more items and prices as needed
    };

    return itemPrices[itemName] || 0.00;
  }

  function addToOrder(itemName, itemPrice) {
    let order = JSON.parse(localStorage.getItem('order')) || [];

    order.push({ name: itemName, price: itemPrice });
    localStorage.setItem('order', JSON.stringify(order));
  }

  function confirmOrder(itemName) {
    const confirmation = confirm(`Added ${itemName} to your order. Do you want to order now?`);
    
    if (confirmation) {
      // Redirect to the order page or perform any other action
      // You can implement this based on your application structure
      alert('Order now'); // Placeholder alert
    } else {
      alert('Think again!');
    }
  }
});
