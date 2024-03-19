<?php include('includes/header.php');
 
if (!authChecker('admin', ['edit_locality'])) { noAccessPage(); }

if(isset($_GET['locid'])){
  $locid = $_GET['locid'];
  $gtqueryloc = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `locality` WHERE `id` = '$locid'"));
}
?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<style>

</style>


<div class="row justify-content-center">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Edit Locality</h6>

                <form class="forms-sample" id="addLocalityForm" enctype="multipart/form-data">
                    <div class='loading'></div>
                    <div class="mb-3">
                        <label for="localityName" class="form-label">Locality Name</label>
                        <input type="text" class="form-control" id="vAdd1" name="localityName" value="<?=$gtqueryloc['locality_name'];?>" required placeholder="Enter Locality Name">
                    </div>


                    <div class="mb-3">
                        <div>
                            <label class="form-label"> Locality</label>
                            <div class="input-field">
                                <input type="text" id="sublocality_level_1" class="form-control"  value="<?=$gtqueryloc['locality'];?>" name="locality" placeholder="locality">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <label class="form-label"> City </label>
                            <div class="input-field">
                                <input type="text" id="locality" class="form-control" name="city"  value="<?=$gtqueryloc['city'];?>" placeholder="City">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <label class="form-label"> State </label>
                            <div class="input-field">
                                <input type="text" id="administrative_area_level_1" class="form-control"  value="<?=$gtqueryloc['state'];?>" name="state" placeholder="State">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <label class="form-label">Pincode </label>
                            <div class="input-field">
                                <input type="number" id="postal_code" class="form-control"  value="<?=$gtqueryloc['pin_code'];?>" name="zip-code" placeholder="10001">
                                <span></span>
                                <input type="hidden" id="latInput" placeholder="latatude" />
                                <input type="hidden" id="lngInput" placeholder="longitude" />
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="hidden" id="locId" value="<?=$gtqueryloc['id'];?>">
                        <button type="button" class="btn btn-primary me-2 w-50" id="EditLocalityBtn">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>

<script>
    var placeSearch, autocomplete;
    var componentForm = {

        sublocality_level_1: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        postal_code: 'short_name'
    };
    var input = document.getElementById('vAdd1');

    function initMap() {
        var geocoder;
        var autocomplete;
        geocoder = new google.maps.Geocoder();
        var card = document.getElementById('locationField');
        autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });

        function fillInAddress(new_address) {
            if (typeof new_address == 'undefined') {
                var place = autocomplete.getPlace(input);
                var latValue = place.geometry.location.lat();
                var lngValue = place.geometry.location.lng();
                // console.log(lngValue);
                var latInput = document.getElementById('latInput');
                var lngInput = document.getElementById('lngInput');
                latInput.value = latValue;
                lngInput.value = lngValue;
            } else {
                place = new_address;
            }
            //console.log(place);
            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            for (var i = 0; i < place.address_components.length; i++) {

                var addressType = place.address_components[i].types[0];
                console.log(addressType);
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

    }
</script>
<script>
    $(document).on("click", "#EditLocalityBtn", function(e) {

        vAdd1 = $('#vAdd1').val();
        locality = $('#sublocality_level_1').val();
        City = $('#locality').val();
        State = $('#administrative_area_level_1').val();
        ZipCode = $('#postal_code').val();
        locId = $('#locId').val();


        if (vAdd1 == "") {
            swicon = "warning";
            msg = "Enter Locality Name Please";
            srbSweetAlret(msg, swicon);
        } else if (locality == "") {
            swicon = "warning";
            msg = "Enter Locality Please";
            srbSweetAlret(msg, swicon);
        } else if (City == "") {
            swicon = "warning";
            msg = "Enter City Please";
            srbSweetAlret(msg, swicon);
        } else if (State == "") {
            swicon = "warning";
            msg = "Enter State Please";
            srbSweetAlret(msg, swicon);
        } else if (ZipCode == "") {
            swicon = "warning";
            msg = "Enter Postal Code  Please";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                url: 'ajax/locality.php',
                type: 'POST',
                data: {
                    vAdd1: vAdd1,
                    locality: locality,
                    City: City,
                    State: State,
                    ZipCode: ZipCode,
                    locId:locId,
                    type: 'Editlocality'
                },

                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        location.href = "view-locality.php";
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                }
            });
        }


    });
</script>