function cardForProduct(title, image, price, oldPrice, discounts) {
    // Create a formatted price string
    let priceStr = `$${price.toFixed(2)}`;
    let oldPriceStr = oldPrice ? `<del>$${oldPrice.toFixed(2)}</del>` : '';

    // Create the HTML structure for the product card
    let html = `
    <div class="product-card">
        <div class="image-holder">
            <div class="badges">
                ${discounts.map(discount => `<span class="badge ${discount.type.toLowerCase()}">${discount.text}</span>`).join('')}
            </div>
            <img src="${image}" alt="${title}">
            <div class="wishlist-btn">
                        <img src="./assets/icons-heart-line.svg" alt="wishlist">
                    </div>
        </div>
        <div class="content3">
         <div class="ratings">
                        <img src="./assets/star-icon.svg" alt="star">
                        <img src="./assets/star-icon-5.svg" alt="star">
                        <img src="./assets/star-icon-4.svg" alt="star">
                        <img src="./assets/star-icon-3.svg" alt="star">
                        <img src="./assets/star-icon-2.svg" alt="star">
                    </div>
            <p class="product-name">${title}</p>
            <div class="price">
                <span class="current-price">${priceStr}</span>
                ${oldPriceStr}
            </div>
        </div>
        <div class="add-to-cart-btn">Add to cart</div>
    </div>`;

    // Append the new product card to the product cards section
    document.querySelector(".product-cards").innerHTML += html;
}

// Example usage:
cardForProduct(
    "Toasted",
    "./assets/image-placeholder-5.svg",
    224.99,
    400.00,
    [
        { type: 'NEW', text: 'NEW' },
        { type: 'discount', text: '-80%' }
    ]
);
cardForProduct(
    "Table",
    "https://th.bing.com/th/id/OIP.HupamI3uR4PKh0JwKEqo-QAAAA?rs=1&pid=ImgDetMain",
    2500.000,
    4000.000,
    [
        {type:  'NEW', text: 'NEW'},
      { type:'discount', text: '-90%'}
    ]
);
cardForProduct(
    "Chair",
    "https://th.bing.com/th/id/OIP.3EGU_1_bxaWsPqPyppa85gHaHa?rs=1&pid=ImgDetMain",
    1500.000,
    6800.000,
    [
        { type: 'NEW', text: 'NEW' },
        {type:'discount',  text: '-40%'}

    ]
);
cardForProduct(
    "Bed",
    "https://img.freepik.com/free-photo/modern-apartment-bedroom-comfortable-bed-near-window-generative-ai_188544-7709.jpg",
    2500.000,
    6000.000,
    [
        { type: 'NEW', text: 'NEW' },
        {type:'discount',  text: '-48%'}

    ]
);
cardForProduct(
    "Fan",
    "https://m.media-amazon.com/images/I/711IXROGDkL.jpg",
    3200.000,
    6900.000,
    [
        { type: 'NEW', text: 'NEW' },
        {type:'discount',  text: '-78%'}

    ]
);

// home.js

document.addEventListener('DOMContentLoaded', function() {
    const closeIcon = document.getElementById('close-icon');
    const notificationBar = document.getElementById('notification-bar');

    closeIcon.addEventListener('click', function() {
        // Hide the notification bar
        notificationBar.style.display = 'none';
        
        // Alternatively, if you want to remove it from the DOM
        // notificationBar.remove();
    });
});
const images = [
    'url(./assets/furmiture.svg)', // Correctedjpg
    'url(./assets/fur3.svg)', // Corrected
    'url(./assets/furniture3.svg)', // Corrected
    'url(./assets/fur.svg)', // Corrected
    'url(./assets/fur2.svg)' // Corrected
];

let currentIndex = 0;

const sliderImage = document.querySelector('.slider-image');

// Function to change the background image
function changeImage() {
    // Remove the active class from the current image
    sliderImage.classList.remove('active');

    // Change the background image after a short delay to allow the dissolve effect
    setTimeout(() => {
        sliderImage.style.backgroundImage = images[currentIndex];
        sliderImage.classList.add('active'); // Show the new image
    }, 1000); // Delay to match the dissolve duration

    currentIndex = (currentIndex + 1) % images.length; // Move to the next image
}

// Initial call to set the first image
sliderImage.style.backgroundImage = images[currentIndex];
sliderImage.classList.add('active'); // Show the first image

// Change the image every 5 seconds
setInterval(changeImage, 3000);