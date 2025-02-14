<?php
global $request_context;
$cart_total = $request_context['data']['cart_total'];
?>

<div class="p-8">
        <h1 class="h1">Checkout informations.</h1>

        <form hx-post="/submit-checkout">
                <label for="fullname">
                        Fullname
                        <input type="text" id="fullname" name="fullname">
                </label>

                <label for="email">
                        Email
                        <input type="email" id="email" name="email">
                </label>

                <label for="tel">
                        Phone number
                        <input type="tel" id="tel" name="tel">
                </label>

                <!-- todo: api gouvernement français vraie address selector -->
                <label for="address">
                        Full address
                        <textarea name="address" id="address"></textarea>
                </label>

                <section>
                        <h2>Order summary</h2>

                        <p>Products count: <?= count($_SESSION['cart']) ?></p>
                        <p>Total price: <?= $cart_total ?>€</p>
                </section>

                <p>By validating this order, you certify that the contact information and address are correct. (Since this is a "fake" website, we do not show the payments informations, to avoid handle all the responsabilities.)</p>
                <p class="font-bold">We are not responsible for incorrect information.</p>

                <button type="submit" class="button">Validate the order</button>
        </form>
</div>