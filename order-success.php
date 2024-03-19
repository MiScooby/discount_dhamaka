<?php include('includes/header.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `deals_order` WHERE `id`='$id'    "));
} else {
    header('location:index.php');
}
?>

<style>
    .main-content-box {
        width: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .content-box {
        text-align: center;
    }
    
    .content-box .container {
        border: 3px solid transparent;
        border-top-color: grey;
        border-bottom-color: grey;
    }
    
    @media screen and (max-width: 480px) {
        .content-box .container {
            font-size: 11.5px !important;
        }
    }
    
    .row>* {
        padding: 0 !important;
        justify-content: space-between !important;
    }
    
    .row {
        justify-content: space-between !important;
    }
    
    h1 {
        font-family: 'Kaushan Script', cursive;
        font-size: 35px !important;
        letter-spacing: 3px;
        color: rgb(62, 160, 62);
        margin: 0;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .content-box p {
        margin: 0;
        font-size: 17px;
        color: #aaa;
        font-family: 'Source Sans Pro', sans-serif;
    }
    
    .go-home {
        color: #fff;
        background: #ffcd64;
        border: 2px solid #ffcd64;
        padding: 10px 35px;
        margin: 30px 0;
        border-radius: 10px;
        text-transform: capitalize;
        transition: 0.3s;
    }
    
    .go-home:hover {
        color: #ffcd64;
        background: #fff;
        border: 2px solid #ffcd64;
        box-shadow: 0 0px 3px 0 rgba(182, 182, 182, 0.432);
    }
    
    .main-content-box {
        height: initial;
        max-width: 700px;
        margin: 50px auto;
    }
</style>



<section class="order-success text-center py-5">

    <div class="container">
        <div class="main-content-box">
            <div class="content-box">
                <div class="icon">
                    <img src="./assets/images/icons/success.png" alt="img" width="100">
                </div>
                <h1 class="py-2">Deal Grabbed Successfully !!</h1>
                <p class="mb-3">You will receive deal detail on your contact number shortly. <br> Your grabbed deal number is <span class="text-dark fw-bold"><?= $getData['order_token'];?></span> </p>

               

                <a href="index.php" class="go-home fw-bold">Continue Browsing</a> 
            </div>
        </div>
    </div>



    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">

</section>


<?php include('includes/footer.php'); ?>