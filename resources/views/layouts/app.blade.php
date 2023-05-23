<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/syndron/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Feb 2023 09:50:47 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->

    <link rel="icon" href="{{ asset(MyApp::ASSET_IMG.'favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link rel="stylesheet" href="{{ asset(MyApp::ASSET_PLUGIN.'notifications/css/lobibox.min.css') }}" />
    <link href="{{ asset(MyApp::ASSET_PLUGIN.'simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset(MyApp::ASSET_PLUGIN.'perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset(MyApp::ASSET_PLUGIN.'metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset(MyApp::ASSET_PLUGIN.'datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <!-- <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap.min.css" rel="stylesheet" /> -->





    <link href="{{ asset(MyApp::ASSET_PLUGIN.'Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
    <!--Select-2-->
    <link href="{{ asset(MyApp::ASSET_PLUGIN.'select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset(MyApp::ASSET_PLUGIN.'select2/css/select2-bootstrap4.css') }}" rel=" stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet'>


    <!-- loader-->
    <!-- <link href="{{ asset(MyApp::ASSET_STYLE.'pace.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset(MyApp::ASSET_SCRIPT.'pace.min.js') }}"></script> -->
    <!-- Bootstrap CSS -->

    <link href="{{ asset(MyApp::ASSET_STYLE.'bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset(MyApp::ASSET_STYLE.'bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset(MyApp::ASSET_STYLE.'app.css') }}" rel="stylesheet">
    <link href="{{ asset(MyApp::ASSET_STYLE.'icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset(MyApp::ASSET_STYLE.'dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset(MyApp::ASSET_STYLE.'semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset(MyApp::ASSET_STYLE.'header-colors.css') }}" />


    <title>{{ env ('APP_NAME') }}</title>

    <script src="{{ asset(MyApp::ASSET_SCRIPT.'bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->


    <script src="{{ asset(MyApp::ASSET_SCRIPT.'jquery.min.js') }}"></script>
    <!--notification js -->
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'notifications/js/notification-custom-script.js') }}"></script>
</head>

<body style="font-family: 'Exo' !important;">
    <!--wrapper-->
    <div class="wrapper">

        <!--start page wrapper -->
        <div class="page-wrapper">

            @yield('content')
        </div>
        <!--end page wrapper -->
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->


    <script src="{{ asset(MyApp::ASSET_PLUGIN.'simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- <script src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js"></script> -->



    <script src="{{ asset(MyApp::ASSET_PLUGIN.'Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
    <!-- Select-2 JS -->
    <script src="{{ asset(MyApp::ASSET_PLUGIN.'select2/js/select2.min.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_SCRIPT.'form-select2.js') }}"></script>


    <script src="{{asset(MyApp::ASSET_SCRIPT.'index.js') }}"></script>
    <script src="{{ asset(MyApp::ASSET_SCRIPT.'add-new-product-image-upload.js') }}"></script>

    <!--app JS-->
    <script src="{{ asset(MyApp::ASSET_SCRIPT.'app.js') }}"></script>
    <script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: true,
            buttons: ['copy', 'excel', 'pdf', 'print'],
        });
        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

    function showAjaxModal(url) {
        $('#modal_ajax').modal('show', {
            backdrop: 'static',
            keyboard: false
        })
        $.ajax({
            url: url,
            success: function(response) {
                jQuery('#modal_ajax .modal-body').html(response);
                $(".datepicker").keydown(function(event) {
                    event.preventDefault();
                });
            }
        });
    }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="modal_ajax" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function confirm_modal(delete_url) {
        $('#modal-4').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
    </script>

    <!-- (Confirm Modal)-->
    <div class="modal fade" id="modal-4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title" style="text-align:center;">Are you sure to Continue ?</h4>
                </div>
                <div class="modal-footer">

                    <a href="#" class="btn btn-danger" id="delete_link">Yes</a>
                    &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const fileInputs = document.querySelectorAll('.file-input');
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = () => {
                const fileData = reader.result;
                const fileType = fileData.split(',')[0].split(':')[1].split(';')[0];

                if (fileType !== 'image/png' && fileType !== 'image/jpeg') {
                    alert('Please upload a PNG or JPEG image.');
                    fileInput.value = ''; // reset the file input field
                    return;
                }

                // file is valid, proceed with uploading or processing it
                // ...
            };
        });
    });
    </script>

    <script>
    const dateInputs = document.querySelectorAll('.date-input');

    dateInputs.forEach((dateInput) => {
        const today = new Date();
        const year = today.getFullYear();
        let month = today.getMonth() + 1;
        let day = today.getDate();

        if (month < 10) {
            month = '0' + month;
        }
        if (day < 10) {
            day = '0' + day;
        }

        const todayString = `${year}-${month}-${day}`;
        dateInput.setAttribute('min', todayString);
    });
    </script>

    <script>
    $(document).ready(function(e) {
        //_________button disable on one click________
        $('form').submit(function() {
            $(this).find('button[type=submit]').prop('disabled', true);
        });
        //_________button disable on enter____________
        if (e.which == 13) {
            e.preventDefault();
            return false;
        }
    });
    </script>

</body>


</html>