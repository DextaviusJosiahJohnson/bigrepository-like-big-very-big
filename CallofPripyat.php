<?php
//Renzo D. NENGASCA
//WD-201
$products = [
    [
        "prod" => "Duty Patch",
        "lightvis" => "https://static.wikia.nocookie.net/stalker/images/5/54/Dolg_Patch.png",
        "desc" => "The Symbol that DUTY uses in S.T.A.L.K.E.R"
    ],
    [
        "prod" => "Monolith Patch",
        "lightvis" => "https://static.wikia.nocookie.net/stalker/images/9/91/Monolith_Patch_Build_1935.webp",
        "desc" => "The Symbol that MONOLITH uses in S.T.A.L.K.E.R"
    ],
    [
        "prod" => "GIS Badge",
        "lightvis" => "https://static.wikia.nocookie.net/stalker/images/9/9c/GIS_LogoMain_Badge.png",
        "desc" => "The Symbol that UNISG uses in S.T.A.L.K.E.R"
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
        function showPreview(image, description) {
            // grabs the preview div from styles.css to style the.. the css :) //
            document.getElementById('preview').style.backgroundImage = "url('" + image + "')";
            document.getElementById('desc').innerText = description;
        }
    </script>

</head>

<body>

<div class="header">
    <h1><?= $title; ?></h1>
    <p><?= $subtitle; ?></p>
</div>

<div class="container">

    <div class="product-list">
        <!-- foreach is just better for arrays and list items specifically as far as i know -->
        <?php foreach ($products as $p): ?>
            <img 
                src="<?= $p['lightvis']; ?>" 
                onmouseover="showPreview('<?= $p['lightvis']; ?>', '<?php echo $p['desc']; ?>')">
        <?php endforeach; ?>
    </div>

    <div>
        <div id="preview" class="preview"></div>
        <!-- i sound so corny here :( -->
        <div id="desc" class="description-box">Hover over a patch to learn more!</div>
    </div>

</div>
<footer>
    <p> Renzo D. Nengasca </p>
</footer>
</body>
</html>
