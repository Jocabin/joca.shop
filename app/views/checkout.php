<?php
global $request_context;
$cart_total = $request_context['data']['cart_total'];
?>

<div class="p-8 flex flex-col gap-8 justify-center items-center w-full">
        <form hx-post="/submit-checkout" class="max-w-[500px] w-full flex flex-col justify-start items-center gap-6">
                <h1 class="h1 w-full">Checkout informations.</h1>

                <label for="fullname">
                        Fullname
                        <input class="input" type="text" id="fullname" name="fullname" placeholder="Auston Matthews">
                </label>

                <label for="email">
                        Email
                        <input class="input" type="email" id="email" name="email" placeholder="amatthews@nhl.ca">
                </label>

                <label for="tel">
                        Phone number
                        <input class="input" type="tel" id="tel" name="tel" placeholder="250 555 0199">
                </label>

                <!-- todo: api gouvernement français vraie address selector -->
                <label for="address">
                        Full address
                        <textarea class="input resize-none" name="address" id="address" placeholder="30 Yonge St, Toronto, ON M5E 1X8, Canada"></textarea>
                </label>

                <section class="w-full">
                        <h2 class="font-bold text-xl w-full">Order summary</h2>

                        <p>You have purchased <span class="font-bold"><?= count($_SESSION['cart']) ?></span> products.</p>
                        <p>Total price: <span class="font-bold"><?= $cart_total ?>€</span></p>
                </section>

                <button type="submit" class="w-full button">Validate the order</button>
        </form>

        <div class="flex flex-col gap-4 mt-8">
                <p>By validating this order, you certify that the contact information and address are correct.</p>
                <p>Since this is a "fake" website, we do not show the payments informations, to avoid handle all the responsabilities.</p>
                <p class="font-bold">We are not responsible for incorrect information.</p>
        </div>
</div>

<style>
        label {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 4px;
        }
</style>