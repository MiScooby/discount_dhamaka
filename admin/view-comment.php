<?php include('includes/header.php'); 
 
if (!authChecker('admin', ['view_comment'])) { noAccessPage(); }

?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">

<?php
if (isset($_GET['cmnt_id'])) {
    $id = $_GET['cmnt_id'];
    $getCmntDet = mysqli_query($con, "SELECT c.*, u.first_name, u.last_name, od.offer_title, od.offer_img, vb.store_name, vb.store_locality FROM comments c, offer_deals od, user u, vendor_brand vb WHERE c.deal_id=od.id AND c.user_id = u.id AND vb.vendor_id=od.vendor_id AND c.id='$id'");
    $localData = mysqli_fetch_array($getCmntDet);
}
?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div class="col-md-12 middle-wrapper">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="../upload/deals-img/<?= $localData['offer_img']; ?>" height="160px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Deal Name</strong> : <?= $localData['offer_title']; ?></h5>
                        <p class="card-text mb-3"><strong>Store Name & Location</strong> : <?= $localData['store_name']; ?> ( <?= $localData['store_locality']; ?> ) </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 grid-margin">
                <div class="card rounded">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img class="img-xs rounded-circle" src="../assets/images/user/1.png" alt="">
                                <div class="ms-2">
                                    <p><?= $localData['first_name'] . " " . $localData['last_name']; ?></p>
                                    <p class="tx-11 text-muted"><?= $localData['ins_date']; ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-3 tx-14"><?= $localData['comments']; ?></p>
                        <img class="img-fluid" src="../../assets/images/photos/img2.jpg" alt="">
                    </div>
                    <div class="card-footer">
                        <div class="d-flex post-actions">

                            <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <p class="d-none d-md-block ms-2">Comment</p>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="divbtn">
                        <button type="button" id="changeStsCMnt" data-id="<?= $localData['id']; ?>" class="btn btn-primary me-2">Click for <?= ($localData['status'] == 0) ? 'Active' : 'Inactive'; ?> Comment</button>
                        <button type="button" id="DltBtn" data-id="<?= $localData['id']; ?>" class="btn btn-danger me-2">Delete
                            Comment</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<script>
    $(document).on("click", "#changeStsCMnt", function() {
        id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change comment status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change status!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result);
                Swal.fire(
                    'Changed!',
                    'Your Comment status has been changed.',
                    'success'
                )
                $.ajax({
                    url: "ajax/comments.php",
                    type: "POST",
                    async: false,
                    data: {
                        id: id,
                        type: 'comntSts'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        });
    });

    $(document).on("click", "#DltBtn", function() {
        id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Delete This comment!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete This comment!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result);
                Swal.fire(
                    'Changed!',
                    'Your Comment Deleted.',
                    'success'
                )
                $.ajax({
                    url: "ajax/comments.php",
                    type: "POST",
                    async: false,
                    data: {
                        id: id,
                        type: 'comntdlt'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            location.href = "comments.php";
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        });
    });
</script>