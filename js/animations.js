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
    ".product_container .view_product_button, .products_page_link"
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


/* PRODUCT */
const product_containers = document.querySelectorAll(".product_container")

product_containers.forEach(product_container => {
  // Create animation for each button
  let container_animation = gsap.to(product_container, {
      paused: true,
      boxShadow: "3px 5px #e9c973"
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