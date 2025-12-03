<?php
declare(strict_types=1);
// Renzo D. NENGASCA
// WD-201

$products = [
    ["prod" => "Duty Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/5/54/Dolg_Patch.png", "desc" => "The Symbol that DUTY uses in S.T.A.L.K.E.R", "price" => 350],
    ["prod" => "Monolith Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/9/91/Monolith_Patch_Build_1935.webp", "desc" => "The Symbol that MONOLITH uses in S.T.A.L.K.E.R", "price" => 450],
    ["prod" => "GIS Badge", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/9/9c/GIS_LogoMain_Badge.png", "desc" => "The Symbol that UNISG uses in S.T.A.L.K.E.R", "price" => 500],
    ["prod" => "Renegade Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/6/60/SCS_Renegades.png", "desc" => "The Symbol that RENEGADE uses in S.T.A.L.K.E.R", "price" => 400],
    ["prod" => "Mercenary Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/4/43/SCS_Mercs.png", "desc" => "The objectively coolest faction, MERCENARY uses this Symbol in S.T.A.L.K.E.R", "price" => 550],
    ["prod" => "Freedom Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/0/00/SCS_Freedom.png", "desc" => "The second objectively coolest faction, FREEDOM uses this in S.T.A.L.K.E.R", "price" => 480],
    ["prod" => "Military Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/2/2c/SCOP_State_Security_Service.png", "desc" => "The Ukrainian Military at the time S.T.A.L.K.E.R took place in uses this Symbol.", "price" => 520],
    ["prod" => "Clear Sky Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/a/a9/SCS_Clear_Sky.png", "desc" => "THE subjectively best faction in S.T.A.L.K.E.R", "price" => 430],
    ["prod" => "SIN Patch", "lightvis" => "https://static.wikia.nocookie.net/lost-alpha/images/1/17/Faction_sin.gif", "desc" => "SIN faction insignia, this faction was actually cut during the production process of a cancelled game in the S.T.A.L.K.E.R franchise called 'S.T.A.L.K.E.R: Oblivion Lost'", "price" => 600],
    ["prod" => "Bandit Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/9/90/SCS_Bandits.png", "desc" => "Bandit faction insignia, Loners but cooler", "price" => 350],
    ["prod" => "Ecologist Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/7/77/SCS_Scientist_emblem.png", "desc" => "Ecologist faction insignia, objectively the most boring faction to join.", "price" => 300],
    ["prod" => "Loner Patch", "lightvis" => "https://static.wikia.nocookie.net/stalker/images/5/52/SCS_Loners.png", "desc" => "Loner faction insignia, Bandits but cooler", "price" => 280],
];

// I am become The Wolf of Wallstreet (i've never watched the wolf of wallstreet i just know its about uhh guys in wallstreet becoming wolves like awooooo)

$inventory = [
    "Duty Patch" => ["price" => 350, "stock" => 8],
    "Monolith Patch" => ["price" => 450, "stock" => 16],
    "GIS Badge" => ["price" => 500, "stock" => 9],
    "Renegade Patch" => ["price" => 400, "stock" => 14],
    "Mercenary Patch" => ["price" => 550, "stock" => 12],
    "Freedom Patch" => ["price" => 480, "stock" => 7],
    "Military Patch" => ["price" => 520, "stock" => 5],
    "Clear Sky Patch" => ["price" => 430, "stock" => 11],
    "SIN Patch" => ["price" => 600, "stock" => 4],
    "Bandit Patch" => ["price" => 350, "stock" => 18],
    "Ecologist Patch" => ["price" => 300, "stock" => 15],
    "Loner Patch" => ["price" => 280, "stock" => 20],
];

$tax_rate = 12;

function get_reorder_message(int $stock): string {
    return ($stock < 10) ? "Yes" : "No";
}

function get_total_value(float $price, int $qty): float {
    return $price * $qty;
}

function get_tax_due(float $price, int $qty, int $tax = 0): float {
    return ($price * $qty) * ($tax / 100);
}

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

    const counts = {};
    cart.forEach(i => counts[i] = (counts[i] || 0) + 1);

    const has = name => cart.some(i => products[i].prod.toUpperCase().includes(name));

    const DUTY = has("DUTY");
    const MONO = has("MONOLITH");
    const USG = has("GIS");
    const REN = has("RENEGADE");
    const MIL = has("MILITARY");
    const MERC = has("MERC");
    const ECO = has("ECOLOGIST");
    const FREE = has("FREEDOM");
    const LONE = has("LONER");
    const BAND = has("BANDIT");
    const CS = has("CLEAR");
    const SIN = has("SIN");

    cart.forEach((productIndex, cartIndex) => {
        const product = products[productIndex];
        subtotal += product.price;

        const div = document.createElement("div");
        div.className = "cart-item";
        div.onclick = () => removeFromCart(cartIndex);

        div.innerHTML = `<img src="${product.lightvis}"><span>${product.prod}</span>`;
        cartBox.appendChild(div);
    });

    // DISCOUNTS (APPLY ONCE) (i should probably make it so some discounts counterract others so it doesnt make it so if you buy one of every patch you just get the biggest discount possible.)

    if (cart.length >= 2) {
        discount += 50;
        appliedDiscounts.push("Pair Discount: -₱50");
    }

    const enemyOfAll = SIN && MONO && USG && REN;
    if (enemyOfAll) {
        discount += 200;
        appliedDiscounts.push("Enemy of All: -₱200");
    }

    if (DUTY && USG && MIL) {
        discount += 100;
        appliedDiscounts.push("Military Adjacent: -₱100");
    }

    if (ECO && USG && MERC) {
        discount += 120;
        appliedDiscounts.push("Contracted: -₱120");
    }

    if (FREE && LONE && BAND) {
        discount += 90;
        appliedDiscounts.push("Pursuit of Freedom: -₱90");
    }

    if (FREE && ECO && CS) {
        discount += 150;
        appliedDiscounts.push("Clarity of the Zone: -₱150");
    }

    if (MONO && SIN && !enemyOfAll) {
        discount += 80;
        appliedDiscounts.push("Children of the Zone: -₱80");
    }

    const total = subtotal - discount;

    const discountList = document.getElementById("discount-list");
    discountList.innerHTML = appliedDiscounts.length > 0
        ? appliedDiscounts.map(d => `<div class="discount-item">✓ ${d}</div>`).join('')
        : '<div style="color: #999;">No discounts applied</div>';

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

<div class="container" style="grid-template-columns: 200px 400px 350px 350px;">

<div class="product-list">
<?php foreach ($products as $i => $p): ?>
<img src="<?= $p['lightvis']; ?>" onclick="addToCart(<?= $i ?>)" onmouseover="showPreview('<?= $p['lightvis']; ?>', '<?= $p['desc']; ?>')">
<?php endforeach; ?>
</div>

<div>
<div id="preview" class="preview"></div>
<div id="desc" class="description-box">Hover over a patch to learn more!</div>
</div>

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

<div class="inventory-box">
<h3>Inventory & Tax Table</h3>

<table>
<tr>
<th>Product</th>
<th>Stock</th>
<th>Reorder?</th>
<th>Value</th>
<th>Tax</th>
</tr>
<!-- wooo business stuff yes yes i understand what i'm doing and did not just copy several youtube videos and change the variables (obviously i understand the code but i did NOT do well when my AP class was teaching us about business stuff so ) -->
<?php foreach ($inventory as $product_name => $data): ?>
<tr>
<td><?= $product_name ?></td>
<td><?= $data["stock"] ?></td>
<td><?= get_reorder_message($data["stock"]) ?></td>
<td>₱<?= number_format(get_total_value($data["price"], $data["stock"]), 2) ?></td>
<td>₱<?= number_format(get_tax_due($data["price"], $data["stock"], $tax_rate), 2) ?></td>
</tr>
<?php endforeach; ?>

</table>
</div>

</div>

<footer><p>Renzo D. Nengasca</p></footer>

</body>
</html>
