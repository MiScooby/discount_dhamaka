<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .custom-card {
            display: flex;
            align-items: center;
            padding: 5px;
        }

        .custom-card img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .custom-card-info {
            display: flex;
            flex-direction: column;
        }

        .custom-card-info span {
            margin-bottom: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: unset;
        }

        .select2-container--default .select2-selection--single {
            height: auto;
        }

        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #aaaaaa83;
        }

        .select2-container--default .select2-selection--single:focus-visible,
        .select2-container--default .select2-search--dropdown .select2-search__field:focus-visible {
            outline: 1px solid #aaaaaaad !important;
        }

        .custom-card-info span:first-of-type {
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <select id="mySelect" style="width: 100%; margin-bottom: 20px;">
        <option value="1"
            data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhtMRbtowke9ZnnGtyYJmIuJaB2Q1y5I-3IA&usqp=CAU"
            data-mobile="123456789" data-email="example1@example.com">
            Option 1</option>
        <option value="2"
            data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhtMRbtowke9ZnnGtyYJmIuJaB2Q1y5I-3IA&usqp=CAU"
            data-mobile="987654321" data-email="example2@example.com">
            Option 2</option>
        <option value="3"
            data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhtMRbtowke9ZnnGtyYJmIuJaB2Q1y5I-3IA&usqp=CAU"
            data-mobile="555555555" data-email="example3@example.com">
            Option 3</option>
    </select>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#mySelect').select2({
                templateResult: formatOption,
                templateSelection: formatOption,
                escapeMarkup: function (markup) {
                    return markup;
                }
            });
            function formatOption(option) {
                if (!option.id) {
                    return option.text;
                }
                var $option = $('<div class="custom-card"><img src="' + $(option.element).data('image') + '" /> <div class="custom-card-info"><span>' + option.text + '</span><span>Mobile: ' + $(option.element).data('mobile') + '</span><span>Email: ' + $(option.element).data('email') + '</span></div></div>');
                return $option;
            }
        });
    </script>
</body>

</html>