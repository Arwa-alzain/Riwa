let pro = document.getElementById("products");

const requestOptions = {
  method: "GET",
  redirect: "follow",
};

fetch("http://localhost/finalProject/getProduct.php", requestOptions)
  .then((response) => response.json())
  .then((result) => {
    console.log(result);
    renderProducts(result);
  })
  .catch((error) => console.error(error));

function renderProducts(result) {
  result.forEach((riwaProduct) => {
    pro.innerHTML += `
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="my-product-card text-center">
            <img src='${riwaProduct.image}' alt='${riwaProduct.name}' />
            <div class="product-name">
              <h5>${riwaProduct.name}</h5>
            </div>
            <div class="product-price text-center">
              <h5>
                ${riwaProduct.price}
                <img
                  src="images/Saudi_Riyal_Symbol-1.png"
                  alt="full"
                  style="width: 20px; height: auto; vertical-align: middle"
                />
              </h5>
            </div>
            <div>
              <button
                type="button"
                class="add-to-cart btn btn-dark"
                data-id="${riwaProduct.id}"
                data-name="${riwaProduct.name}"
                data-price="${riwaProduct.price}"
                data-image="${riwaProduct.image}"
              >
                اشترِ الآن
              </button>
            </div>
          </div>
        </div>
            `;
  });
}

const addToCartButtons = document.querySelectorAll(".add-to-cart");
const cartCountSpan = document.getElementById("cart-count");

let cartItems = JSON.parse(localStorage.getItem("cart")) || [];

function updateCartCount() {
  let totalQuantity = cartItems.reduce(
    (sum, item) => sum + (item.quantity || 1),
    0
  );
  cartCountSpan.textContent = totalQuantity;
}

updateCartCount();

document.getElementById("products").addEventListener("click", function (e) {
  if (e.target.classList.contains("add-to-cart")) {
    console.log("زر تم الضغط عليه:", e.target);

    const button = e.target;
    const name = button.dataset.name;
    const price = button.dataset.price;
    const image = button.dataset.image;

    const existingIndex = cartItems.findIndex((item) => item.name === name);

    if (existingIndex > -1) {
      cartItems[existingIndex].quantity =
        (cartItems[existingIndex].quantity || 1) + 1;
    } else {
      cartItems.push({ name, price, image, quantity: 1 });
    }

    localStorage.setItem("cart", JSON.stringify(cartItems));
    updateCartCount();

    const toast = document.getElementById("add-toast");
    if (toast) {
      toast.innerHTML = `تمت إضافة "${name}" إلى السلة`;
      toast.style.display = "block";
      setTimeout(() => {
        toast.style.display = "none";
      }, 2000);
    }
  }
});



