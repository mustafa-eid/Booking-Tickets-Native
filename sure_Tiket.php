<?php
ob_start();

include_once __DIR__."\app/database/config.php";
include_once __DIR__."\app/database/operations.php";
// include_once __DIR__."\app/middleware/guest.php";
include_once __DIR__."\app/models/party.php";
include_once __DIR__."\app/models/user.php";



$user_object = new User();
$user_result = $user_object->read();
if(!empty($user_result)) {
    $users = $user_result->fetch_all(MYSQLI_ASSOC);
    foreach($users as $user){
        // echo $user['email'];die;
    }
}


if(!empty($user_result)) {
    $users_data = $user_result->fetch_all(MYSQLI_ASSOC);
    foreach($users_data as $user){
        // echo $user['email'];die;
    }
}


$party = new Party();
$parties_result = $party->read_party_by_id();

if(!empty($parties_result)) {
    $parties = $parties_result->fetch_all(MYSQLI_ASSOC);
    foreach($parties as $party){
        // echo $party['name'];die;
    }
}


if($party['location'] == 'el-manara'){
    $total_ather_people = $user['ather_people'] * 200;
}elseif($party['location'] == 'the guard'){
    $total_ather_people = $user['ather_people'] * 140;
}



//fawry
$merchantRefNum = time();

$total_price = $total_ather_people + $party['price'];
$total = number_format($total_price, 2, '.', '');
$price_2 = $total;

$signature = "770000014344" . $merchantRefNum . "https://fawrydeveloper.com/" . "1234" . "1" . $price_2 . "8fadfe1f-17cd-4cfe-a93c-f45a4fa146b1";
$segnature_hash = hash('sha256', $signature);




$url = 'https://getpasstickets.com/support/';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="this is teba lab">


    <title>project</title>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="Css/all.min.css">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/nav&footer.css">
    <link rel="stylesheet" href="Css/Tiket.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@700&family=Imperial+Script&display=swap"
        rel="stylesheet">


    <!-- Import FawryPay CSS Library-->
    <link rel="stylesheet"
        href="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/css/fawrypay-payments.css">

    <!-- Import FawryPay Staging JavaScript Library-->
    <script src="https://cdn.jsdelivr.net/gh/emn178/js-sha256/build/sha256.min.js"></script>
    <script type="text/javascript"
        src="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script>

    <script>
    function checkout() {
        const configuration = {
            locale: "en",
            mode: DISPLAY_MODE.SEPARATED,
        };
        FawryPay.checkout(buildChargeRequest(), configuration);
    }

    function buildChargeRequest() {
        const chargeRequest = {
            merchantCode: "770000014344",
            merchantRefNum: "<?php echo $merchantRefNum; ?>",
            customerMobile: "<?= $user['phone']; ?>",
            customerEmail: "<?= $user['email']; ?>",
            customerName: "<?= $user['first_name']; ?>",
            paymentExpiry: "",
            customerProfileId: "",
            language: "en-gb",
            chargeItems: [{
                itemId: "1234",
                description: "1234",
                price: <?php echo $price_2; ?>,
                quantity: 1,
            }],
            paymentMethod: "",
            returnUrl: "https://fawrydeveloper.com/",
            signature: "<?php echo $segnature_hash; ?>",
        };
        return chargeRequest;
    };
    </script>

</head>

<body>
    <nav>
        <div class="container">
            <div class="row  align-items-center content">
                <div class="col-1 pe-0 text-center ">
                    <div id="barsContent">
                        <i class="fa-solid fa-bars fs-5"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-5 pe-0 ps-0">
                    <img src="Images/WhatsApp_Image_2023-05-02_at_00.27.08-removebg-preview.png" alt="">
                </div>
                <div class="col-md-8 ps-0">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about_us.php">About Us</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                        <li><a href="collection.php">Collections</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <aside class="left-side">
        <div id="cancel">x</div>
        <a href="admin.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="collection.php"><i class="fa-regular fa-address-card"></i> Collections</a>
        <a href=""><i class="fa-solid fa-user"></i> Sign out</a>
    </aside>

    <section class="Tiket-data text-center pb-md-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <img class="mb-4 mt-5" src="Images/WhatsApp_Image_2023-05-02_at_00.27.08-removebg-preview (1).png"
                        alt="">
                    <h2 class="mb-0">Welcome to GetPass Tickets</h2>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-12 col-lg-9 m-lg-auto">
                    <div class="row align-items-center w-100">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="data-left">
                                <div class="text-start">
                                    <img src="Images/add card.jpg" alt="" width="300px">
                                    <p class="text-light mt-3"><?=$party['name']?></p>
                                    <p class="text-light"><?=$party['date']?> - <?=$party['time']?></p>
                                </div>
                                <button class="btn-back float-start mt-3 mb-3">
                                    <a href="data-number-tiket.php"
                                        class="text-decoration-none text-light p-md-5 pt-3 pb-3">
                                        Back
                                    </a>
                                </button>
                            </div>
                        </div>
                        <div class="col-1 p-0 d-none d-lg-block">
                            <div class="vertical-line"></div>
                        </div>
                        <div class="col-12 col-md-5 text-light text-start">
                            <div class="row ms-1 borderbottom mb-3 mt-3">

                                <div class="col-3 p-0">
                                    <p>Party Name</p>
                                </div>
                                <div class="col-3">
                                    <p>Student Tiket Price</p>
                                </div>
                                <div class="col-3">Other Tiket Price</div>
                            </div>
                            <div class="row ms-1 borderbottom">
                                <div class="col-3 p-0">
                                    <p><?=$party['name']?></p>
                                </div>
                                <div class="col-3 student-price"><?=$party['price']?>LE</div>

                                
                                <div class="col-3 other-price"><?=$total_ather_people?>LE</div>
                            </div>
                            <div class="row ms-1 borderbottom mb-3 mt-3">
                                <div class="col-6 p-0">
                                    <p>Total</p>
                                </div>
                                <div class="col-6 pe-md-5">
                                    <?php
                                        $total_price = $total_ather_people + $party['price'];
                                    ?>
                                    <p class="text-end total-price"><?=$total_price?>LE</p>
                                </div>
                            </div>


                            <!-- FawryPay Checkout Button -->
                            <input type="image" onclick="checkout();"
                                src="https://www.atfawry.com/assets/img/FawryPayLogo.jpg" alt="pay-using-fawry"
                                id="fawry-payment-btn" />


                        </div>
                    </div>
                </div>
            </div>
    </section>

    <footer>
        <div class="container">
            <div class="row align-items-end">
                <div class="col-5 d-md-none footer-link">
                    <ul>
                        <li><a href="admin.php">Home</a></li>
                        <li><a href="about_us.php">About Us</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                        <li><a href="collection.php">Collections</a></li>
                    </ul>
                </div>
                <div class="col-7 col-md-12 text-center">
                    <div class="links-contact">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/main.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
</body>

</html>

<?php
ob_end_flush();
?>

<!-- "0d81daf38d0325b953732ff183332ba51d90ab59e8ef61963d572dd728b4bbf2" -->