<?php include('includes/header.php');


if (!authChecker('admin', ['edit_vendor_brand', 'view_vendor_brand'])) {
    noAccessPage();
}

if (isset($_GET['vendor_id'])) {
    $id = $_GET['vendor_id'];
    $brandQuery = mysqli_query($con, "SELECT vb.*, v.email_id FROM vendor_brand vb, vendor v WHERE vb.vendor_id='$id' AND v.id = vb.vendor_id;");
    $storeCountBrnd = mysqli_num_rows($brandQuery);
    $getBrandStore = mysqli_fetch_array($brandQuery);

    //  echo "SELECT vb.*, v.email_id FROM vendor_brand vb, vendor v WHERE vb.vendor_id='$id' AND v.id = vb.vendor_id;";
}
?>
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">

<style>
    .dropify-font-upload:before,
    .dropify-wrapper .dropify-message span.file-icon:before {
        content: '\e800';
        display: none;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 38px;
        border: 1px solid #e9ecef !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 23px;
    }

    .pass1 {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 25px;
        top: 12px;
        color: #000865;
        font-weight: 500;
        cursor: pointer;
    }

    .userinfodiv {
        background: #fcfcfcc4;
        padding: 20px 20px 8px;
        border-radius: 20px;
        border: 1px solid #f6f6f6cc;
    }

    .divbtn {
        padding-top: 10px;
    }

    .dropify-wrapper {
        height: 100px;
    }

    .dropify-wrapper .dropify-message span.file-icon {
        font-size: 20px;
    }

    .userinfodiv .forms-sample .form-label {
        font-weight: 500;
        color: #030414bd;
        font-size: 12px;
    }

    .row.mb-3 {
        display: flex;
        align-items: center;
    }

    .useravatar img {
        width: 90px;
    }

    .sec-head {
        font-weight: 600;
        margin-bottom: 15px;
        color: #2bc79c;
    }

    .notedesc {
        font-size: 11px;
        color: #747474;
        font-weight: 500;
    }

    .notedesc ul {
        margin-left: 10px;
        padding: 0;
    }
</style>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6  stretch-card align-items-center">
                        <h5 class="card-title">EDIT VENDOR BRAND / VENDOR BRAND DETAILS</h5>
                    </div>
                    <div class="col-md-6 mb-2 grid-margin stretch-card justify-content-end">
                        <a href="mailto:<?= $getBrandStore['email_id']; ?> " class="btn btn-success me-2">Send Email to vendor</a>
                    </div>

                </div>

                <div class="userinfodiv">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="sec-head">Vendor Brand Details :</p>
                        </div>
                        <div class="col-md-12">

                            <form id="vendorBrandForm" class="forms-sample" action="javascript:;" enctype="multipart/form-data">
                                <input type="hidden" id="vendorId" name="vendorId" value="<?= $id ?>">

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Brand Name:</label>
                                    </div>
                                    <div class="col-md-9">

                                        <input class="form-control mb-4 mb-md-0" name="BrandName" type="text" value="<?= $getBrandStore['store_name']; ?>" />


                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Brand Logo:</label>
                                    </div>
                                    <div class="col-md-9">

                                        <div class="d-flex">
                                            <img src="../upload/vendor-doc/brand-logo/<?= $getBrandStore['brand_logo']; ?>" class="pe-2" width="120px" alt="">
                                            <input class="form-control mb-4 mb-md-0" name="BrandLogo" id="BrandLogo" type="file" />
                                        </div>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Brand Description:</label>
                                    </div>
                                    <div class="col-md-9">

                                        <textarea id="myDesc" class="editor" name="myDesc" rows="10" cols="80" required="">
                                            <?= (!empty($getBrandStore['store_desc'])) ? '' . $getBrandStore['store_desc'] . '' : ''; ?>
                                            </textarea>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Brand Location:</label>
                                    </div>



                                    <div class="col-md-9">
                                        <select class="js-example-basic-single form-control" name="BrandLocation" id="BrandLocation">
                                            <option></option>
                                            <?php
                                            $getCat = mysqli_query($con, "SELECT * FROM `locality` WHERE `status`='Active' ");
                                            while ($getCatDet = mysqli_fetch_array($getCat)) {
                                            ?>
                                                <option value="<?= $getCatDet['locality']; ?>" <?= ($getBrandStore['store_locality'] ==  $getCatDet['locality']) ? 'selected' : ''; ?>><?= $getCatDet['locality']; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>




                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Brand Locality:</label>
                                    </div>



                                    <div class="col-md-9">
                                        <div id="locationField">
                                            <input id="autocomplete" value="<?= $getBrandStore['store_location']; ?>" placeholder="Enter your address" class="form-control" name="preLoc" type="text"></input>
                                        </div>
                                        <input type="hidden" id="latInput" value="<?= $getBrandStore['store_lat']; ?>" name="latInput" placeholder="latatude" />
                                        <input type="hidden" id="lngInput" value="<?= $getBrandStore['store_lng']; ?>" name="lngInput" placeholder="longitude" />

                                        <div class="row p-3 mt-1">
                                            <div id="map" style="height: 350px;"></div>
                                            <div id="infowindow-content">
                                                <img src="" width="16" height="16" style="display: none;" id="place-icon">
                                                <span id="place-name" class="title"></span><br>
                                                <span id="place-address"></span>
                                            </div>
                                        </div>
                                    </div>




                                </div>

                                <div class="col-md-12 text-center">
                                    <div class=" ">
                                        <input type="hidden" name="formsubmitType" value="VendorBrandEdit">
                                        <button type="submit" id="saveBrandbtn" class="btn btn-primary me-2">Save Vendor Brand Details</button>

                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/super-build/ckeditor.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>
<script>
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };



    var input = document.getElementById('autocomplete');

    function initMap() {
        var geocoder;
        var autocomplete;

        geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: <?= (isset($getBrandStore['store_lat'])) ? '' . $getBrandStore['store_lat'] . '' : '28.6139';  ?>,
                lng: <?= (isset($getBrandStore['store_lng'])) ? '' . $getBrandStore['store_lng'] . '' : '77.2090';  ?>,

            },
            zoom: 15
        });
        var marker = new google.maps.Marker({
            position: {
                lat: <?= (isset($getBrandStore['store_lat'])) ? '' . $getBrandStore['store_lat'] . '' : '28.6139';  ?>,
                lng: <?= (isset($getBrandStore['store_lng'])) ? '' . $getBrandStore['store_lng'] . '' : '77.2090';  ?>,
            },
            map: map,

        });
        var card = document.getElementById('locationField');
        autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            console.log(place);

            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
            fillInAddress();

        });

        function fillInAddress(new_address) { // optional parameter
            if (typeof new_address == 'undefined') {
                var place = autocomplete.getPlace(input);
                var latValue = place.geometry.location.lat();
                var lngValue = place.geometry.location.lng();
                console.log(lngValue);
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
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        // console.log(autocomplete);
                        $('#autocomplete').val(results[0].formatted_address);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                        // google.maps.event.trigger(autocomplete, 'place_changed');
                        fillInAddress(results[0]);
                    }
                }
            });
        });
    }
</script>
<script>
    $('#BrandLogo').dropify();
    $('.js-example-basic-single').select2({
        placeholder: 'Please Select An Option..'
    });
</script>
<script>
    $(".editor").each(function() {
        var __editorName = $(this).attr('id');
        CKEDITOR.ClassicEditor.create(document.getElementById(__editorName), {

            toolbar: {
                items: [

                    'heading', '|',
                    'bold', 'italic', 'underline', '|',

                    'undo', 'redo', 'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',

                    'insertImage',
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: '',
            height: 600,

            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
        });
    });
</script>

<script>
    $(document).on("submit", "#vendorBrandForm", function() {
        $.ajax({
            url: 'ajax/vendors.php',
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#saveBrandbtn").text("Please Wait..");
            },
            complete: function() {
                $("#saveBrandbtn").text("Save Vendor Brand Details");
            },
            success: function(data) {
                if (data.status == 1) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });
    });
</script>