<?php
//Renzo D. NENGASCA
//WD-201
$products = [
    [
        "prod" => "Duty Patch",
        "lightvis" => "https://static.wikia.nocookie.net/stalker/images/5/54/Dolg_Patch.png",
        "desc" => "The Symbol that DUTY uses in S.T.A.L.K.E.R",
        "price" => 350
    ],
    [
        "prod" => "Monolith Patch",
        "lightvis" => "https://static.wikia.nocookie.net/stalker/images/9/91/Monolith_Patch_Build_1935.webp",
        "desc" => "The Symbol that MONOLITH uses in S.T.A.L.K.E.R",
        "price" => 450
    ],
    [
        "prod" => "GIS Badge",
        "lightvis" => "https://static.wikia.nocookie.net/stalker/images/9/9c/GIS_LogoMain_Badge.png",
        "desc" => "The Symbol that UNISG uses in S.T.A.L.K.E.R",
        "price" => 500
    ],
];

$title = "Patches of the Zone";
$subtitle = "A brief collection of iconic faction emblems from the S.T.A.L.K.E.R. universe.";
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>

    <style>
        <?php include 'styles/styles.css'; ?>
    </style>

    <script>
        // we use PHP cause we're coding on php :)
        // please find it funny :(
        // i'm just using whatever i learned from doing alot of google searches and also previous things i picked up from self-studying introweb
        const products = <?= json_encode($products); ?>;
        let cart = [];

        function showPreview(image, description) {
            document.getElementById('preview').style.backgroundImage = "url('" + image + "')";
            document.getElementById('desc').innerText = description;
        }

        function addToCart(index) {
            cart.push(index);
            updateCartDisplay();
        }

        function removeFromCart(cartIndex) {
            cart.splice(cartIndex, 1);
            updateCartDisplay();
        }

        function updateCartDisplay() {
            const cartBox = document.getElementById("cart-items");
            cartBox.innerHTML = "";

            let subtotal = 0;
            let discount = 0;
            let appliedDiscounts = [];

            // we're counting how many of the patches and which have been selected
            const counts = {0: 0, 1: 0, 2: 0};
            cart.forEach(i => counts[i]++);

            const hasDuty = counts[0] > 0;
            const hasMono = counts[1] > 0;
            const hasUnisg = counts[2] > 0;

            // displaying how many we got and the totals
            cart.forEach((productIndex, cartIndex) => {
                const product = products[productIndex];
                subtotal += product.price;

                const div = document.createElement("div");
                div.className = "cart-item";
                div.onclick = () => removeFromCart(cartIndex);

                div.innerHTML = `
                    <img src="${product.lightvis}">
                    <span>${product.prod}</span>
                `;
                cartBox.appendChild(div);
            });

            <?php
            // these discounts are only supposed to apply once //
            // i'm so creative with names //
            ?>

            <?php if (true): ?>
            if (cart.length >= 2) {
                discount += 50;
                appliedDiscounts.push("Pair Discount: -₱50");
            }
            <?php endif; ?>

            <?php if (true): ?>
            if (hasMono && hasUnisg) {
                discount += 100;
                appliedDiscounts.push("Enemy of All: -₱100");
            }
            <?php endif; ?>

            <?php if (true): ?>
            if (hasDuty && hasUnisg) {
                discount += 75;
                appliedDiscounts.push("Military Adjacent: -₱75");
            }
            <?php endif; ?>


            const total = subtotal - discount;

            //i thought really hard about these names so i want everyone to see them //
            const discountList = document.getElementById("discount-list");
            if (appliedDiscounts.length > 0) {
                discountList.innerHTML = appliedDiscounts.map(d => 
                    `<div class="discount-item">✓ ${d}</div>`
                ).join('');
            } else {
                discountList.innerHTML = '<div style="color: #999;">No discounts applied</div>';
            }

            document.getElementById("subtotal").innerText = "₱" + subtotal;
            document.getElementById("discount").innerText = "-₱" + discount;
            document.getElementById("total").innerText = "₱" + total;
        }
    </script>

</head>

<body>

<div class="header">
    <h1><?= $title; ?></h1>
    <p><?= $subtitle; ?></p>
</div>

<div class="container" style="grid-template-columns: 200px 400px 350px;">

    <!-- showing off the patches :D -->
    <div class="product-list">
        <?php foreach ($products as $i => $p): ?>
            <img 
                src="<?= $p['lightvis']; ?>" 
                onclick="addToCart(<?= $i ?>)"
                onmouseover="showPreview('<?= $p['lightvis']; ?>', '<?= $p['desc']; ?>')">
        <?php endforeach; ?>
    </div>

    <!-- "Hover over the patches to learn more!" WHO SAYS THAT -->
    <div>
        <div id="preview" class="preview"></div>
        <div id="desc" class="description-box">Hover over a patch to learn more!</div>
    </div>

    <!-- i have decided that these should be really expensive because i am a small business therefore i need to make an egregiously large profit despite the small quantity and quality of my products -->
    <div class="cart-box">
        <h3>Selected Patches</h3>
        <p>Click an item to remove it.</p>

        <div id="cart-items" class="cart-items"></div>

        <div id="discount-list" class="discount-list"></div>

        <div class="totals">
            <p>Subtotal: <span id="subtotal">₱0</span></p>
            <p>Discounts: <span id="discount">₱0</span></p>
            <p><strong>Total: <span id="total">₱0</span></strong></p>
        </div>
    </div>

</div>

<footer>
    <p> Renzo D. Nengasca </p>
</footer>
</body>
</html>