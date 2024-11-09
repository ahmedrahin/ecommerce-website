/*================================
  Add To Cart Notification js
  ==================================*/
  window.addEventListener('load', () => {
    const addToCartButton = document.querySelectorAll(".addtocart-btn ");
    addToCartButton.forEach((el) => {
        el.addEventListener("click", function () {
            document.querySelector(".addToCart").classList.add("show");
            setTimeout(() => {
                document.querySelector(".addToCart").classList.remove("show")
            }, 4000);
        })
    });
    const wishListButton = document.querySelectorAll(".wishlist-btn ");
    wishListButton.forEach((el) => {
        el.addEventListener("click", function () {
            document.querySelector(".addToWishlist").classList.add("show");
            setTimeout(() => {
                document.querySelector(".addToWishlist").classList.remove("show")
            }, 4000);
        })
    })

});