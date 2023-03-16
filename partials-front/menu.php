<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Fav Icon -->
     <link rel="icon" type="image/png" href="images/logo.png" width="75px">

    <title>Sonja's Kitchen</title>
    
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">

    <script>
function initGTM() {}
var dataLayer = dataLayer || [];
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NVTW3R');
        </script>
        <script type="application/ld+json">{
    "@context": "https://www.endless-technology.com.na",
    "@type": "WebPage",
    "name": "build the map to you business",
    "description": "With a website: Build the best website can attarct and keep your customer glued to your products! personal, small business and mega business or an organization",
    "publisher": {
        "@type": "business",
        "name": "",
        "url": "https://sonja.com/",
        "logo": {
            "@type": "imageObject",
            "url": "C:\xampp\htdocs\Restaurant\images\logo.png"
        }
    }
}
</script>

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>banking-details.php">Banking Details</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->