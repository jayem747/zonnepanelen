/*
ANIMATION SECTIONS

- GENERAL SECTION
- HEADER SECTION
- FOOTER SECTION
- MAIN SECTION
*/


/* GENERAL SECTION */
/* 
CONTENT
- BUTTONS
- PRODUCT
*/

/* BUTTONS */
const product_buttons = document.querySelectorAll(
    ".product_container .view_product_button, .products_page_link, .product_delete_bt"
);

const product_buttons_blue = document.querySelectorAll(
    ".product_edit_bt"
);

product_buttons.forEach(product_button => {
    // Create animation for each button
    let button_animation = gsap.to(product_button, {
        paused: true,
        boxShadow: "3px 5px #cad8de"
    });

 
    product_button.addEventListener("mouseenter", () => button_animation.play());
    product_button.addEventListener("mouseleave", () => button_animation.reverse());
});

product_buttons_blue.forEach(product_button => {
    // Create animation for each button
    let button_animation = gsap.to(product_button, {
        paused: true,
        boxShadow: "3px 5px #637ba0"
    });

 
    product_button.addEventListener("mouseenter", () => button_animation.play());
    product_button.addEventListener("mouseleave", () => button_animation.reverse());
});

/* PRODUCT */
const product_containers = document.querySelectorAll(".product_container")

product_containers.forEach(product_container => {
  // Create animation for each button
  let container_animation = gsap.to(product_container, {
      paused: true,
      boxShadow: "10px 15px #637ba0"
  });

  product_container.addEventListener("mouseenter", () => container_animation.play());
  product_container.addEventListener("mouseleave", () => container_animation.reverse());
});
/*-----------------------------------------------------------------------------*/


/* HEADER SECTION */

/*-----------------------------------------------------------------------------*/


/* FOOTER SECTION */

/*-----------------------------------------------------------------------------*/


/* MAIN SECTION */
/*
CONTENT
- INDEX.PHP
*/

/* INDEX.PHP */

/*-----------------------------------------------------------------------------*/