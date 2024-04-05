<?php
function main_header($menubar = [])
{
    defined('BASEPATH') or exit('No direct script access allowed');
    $session = (object) get_userdata(USER);
    // var_dump($session);
    $ci = &get_instance();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
    .hover-effect:hover {
        background-color: #FFB1B3;
        border-radius: 5px;
        color: white;
    }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TUPDTR_Portal</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/dist/css/adminlte.min.css">
    <!-- SweetAlert -->
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/toastr/toastr.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="icon" href="<?php echo base_url() ?>assets/images/Logo/logo.jpg">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/ekko-lightbox/ekko-lightbox.css">

    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="flex-column justify-content-center align-items-center">
 <img class="animation__wobble" src="<?= base_url() ?>assets/images/Logo/logo.jpg"  height="200" width="200"> 
    <h1 class="animation__wobble" height="200" width="200">TUP DTR PROJECT</h1>
  </div>-->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark" style="background-color:#9f3a3b;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <h5 class="text-white"><b>
                            <?= date('M d, Y - h:i A'); ?>
                        </b></h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="signout" role="button">
                        <i class="fas fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="Dashboard" class="brand-link" style="background-color:#9f3a3b;">
                <img src="<?= base_url() ?>assets/images/Logo/tuplogo.png" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span style="font-size:12px;" class="brand-text font-weight-light">Daily Time Record Portal
                    System</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="background-color:white;">
                <!-- <div class="sidebar"> -->
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!--     <div class="image">
          <img src="<?= base_url() ?>assets/theme/adminlte/adminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
                    <div class="info text-wrap">
                        <a style="font-weight:bold;color:black;"
                            href="<?= base_url() ?>/user_profile/index/<?= $session->U_ID ?>" class="d-block"> Welcome,
                            <br>
                            <?= $session->Fname ?>
                            <?= $session->Mname ?>
                            <?= $session->Lname ?>
                        </a>

                    </div>



                </div>
                <!-- <button class="btn btn-sm btn-flat btn-primary" id="change" value="Cebu">Change</button> -->
                <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">

                            <ul class="nav nav-item hover-effect">
                                <li class="nav-item">
                                    <a style="color:<?= (sidebar($menubar, ['Dashboard'])) ? 'white' : 'black' ?>; display:<?= $session->User_type == "HR" ? 'none' : '' ?>;"
                                        href="<?= base_url() ?>Dashboard"
                                        class="nav-link <?= (sidebar($menubar, ['Dashboard'])) ? 'active' : '' ?>">
                                        <i class="fas fa-home nav-icon"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <ul class="nav nav-item hover-effect">
                            <li class="nav-item">
                                <a style="color:<?= (sidebar($menubar, ['schedule'])) ? 'white' : 'black' ?>;"
                                    href="<?= base_url() ?>schedule"
                                    class="nav-link <?= (sidebar($menubar, ['schedule'])) ? 'active' : '' ?>">
                                    <i class="fas fa-save nav-icon"></i>

                                    <p>View Schedule</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-item">
                            <li class="nav-item">
                                <a style="color:<?= (sidebar($menubar, ['program_head'])) ? 'white' : 'black' ?>;"
                                    href="<?= base_url() ?>program_head"
                                    class="nav-link <?= (sidebar($menubar, ['program_head'])) ? 'active' : '' ?>">
                                    <i class="fas fa-calendar-alt nav-icon"></i>
                                    <p>Program Head</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-item hover-effect">
                            <li class="nav-item">
                                <a style="color:<?= (sidebar($menubar, ['request'])) ? 'white' : 'black' ?>; display:<?= $session->User_type == "faculty" ? 'none' : '' ?>;"
                                    href="<?= base_url() ?>request"
                                    class="nav-link <?= (sidebar($menubar, ['request'])) ? 'active' : '' ?>">
                                    <i class="fas fa-envelope nav-icon"></i>
                                    <p>Request</p>
                                </a>
                            </li>
                        </ul>

                        <li class="nav-item hover-effect">
                            <ul class="nav nav-item">
                                <a style="color:<?= (sidebar($menubar, ['Faculty_schedule'])) ? 'white' : 'black' ?>; display:<?= $session->User_type == "HR" ? 'none' : '' ?>;"
                                    href="<?= base_url() ?>faculty_schedule"
                                    class="nav-link <?= (sidebar($menubar, ['Faculty_schedule'])) ? 'active' : '' ?>">
                                    <i class="fas fa-calendar-alt nav-icon"></i>
                                    <p>Encode Schedule</p>
                                </a>
                            </ul>
                        </li>

                        <ul class="nav nav-item hover-effect">
                            <li class="nav-item">
                                <a style="color:<?= (sidebar($menubar, ['upload_attachments'])) ? 'white' : 'black' ?>; display:<?= $session->User_type == "HR" ? 'none' : '' ?>"
                                    href="<?= base_url() ?>upload_attachments"
                                    class="nav-link <?= (sidebar($menubar, ['upload_attachments'])) ? 'active' : '' ?>">
                                    <i class="fas fa-upload nav-icon"></i>
                                    <p>Upload Attachments</p>
                                </a>
                            </li>
                        </ul>

                        <!-- <li class="nav-item">
                <ul class="nav nav-item">
                  <a style="color:<?= (sidebar($menubar, ['Scan'])) ? 'white' : 'black' ?>; display:<?= $session->User_type == "faculty" ? 'none' : '' ?>;" href="<?= base_url() ?>scan"
                    class="nav-link <?= (sidebar($menubar, ['Scan'])) ? 'active' : '' ?>">
                    <i class="fas fa-qrcode nav-icon"></i>
                    <p>Scan</p>
                  </a>
                </ul>
              </li> -->

                        <li class="nav-item hover-effect">
                            <ul class="nav nav-item">
                                <a style="color:<?= (sidebar($menubar, ['Reports'])) ? 'white' : 'black' ?>; display:<?= $session->User_type == "faculty" ? 'none' : '' ?>;"
                                    href="<?= base_url() ?>Reports"
                                    class="nav-link <?= (sidebar($menubar, ['Reports'])) ? 'active' : '' ?>">
                                    <i class="fas fa-chart-bar nav-icon"></i> <!-- Change the icon class here -->
                                    <p>Reports</p>
                                </a>
                            </ul>
                        </li>

                        <!-- <ul class="nav nav-item">
                            <li class="nav-item">
                                <a style="color:<?= (sidebar($menubar, ['Create_User'])) ? 'white' : 'black' ?>; display:<?= $session->User_type == "faculty" ? 'none' : '' ?>;"
                                    href="<?= base_url() ?>create_user"
                                    class="nav-link <?= (sidebar($menubar, ['Create_User'])) ? 'active' : '' ?>">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Create User</p>
                                </a>
                            </li>
                        </ul> -->

                        <li
                            class="nav-item
                            <?= (sidebar($menubar, ['Create_User'])) || sidebar($menubar, ['Manage_Departments']) || sidebar($menubar, ['Manage_Subjects']) ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link"
                                style="color:<?= (sidebar($menubar, ['Create_User'])) || sidebar($menubar, ['Manage_Departments']) || sidebar($menubar, ['Manage_Subjects']) ? 'white' : 'black' ?>; display:<?= $session->User_type == "HR" || $session->User_type == "admin" ? '' : 'none' ?>">
                                <i class="fas fa-user-tie"></i>
                                <p>
                                    Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item hover-effect">
                                    <a style="color:<?= (sidebar($menubar, ['Create_User'])) ? 'white' : 'black' ?>;"
                                        href="<?= base_url() ?>create_user"
                                        class="nav-link <?= (sidebar($menubar, ['Create_User'])) ? 'active' : '' ?>">
                                        <i class="fas fa-user-plus nav-icon"></i>
                                        <p>Create User</p>
                                    </a>
                                </li>
                                <li class="nav-item hover-effect">
                                    <a style="color:<?= (sidebar($menubar, ['Manage_Subjects'])) ? 'white' : 'black' ?>;"
                                        href="<?= base_url() ?>subjects"
                                        class="nav-link <?= (sidebar($menubar, ['Manage_Subjects'])) ? 'active' : '' ?>">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Subjects</p>
                                    </a>
                                </li>
                                <li class="nav-item hover-effect">
                                    <a style="color:<?= (sidebar($menubar, ['Manage_Departments'])) ? 'white' : 'black' ?>;"
                                        href="<?= base_url() ?>departments"
                                        class="nav-link <?= (sidebar($menubar, ['Manage_Departments'])) ? 'active' : '' ?>">
                                        <i class="fas fa-building nav-icon"></i>
                                        <p>Departments</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                    </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="modal" tabindex="-1" role="dialog" id="idle">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">You are Idling</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h4 style="color: red;">
                            YOU SESSION WILL BE LOGGED OUT SOON IF YOU DONT MOVE YOUR MOUSE, PRESS ANY KEY ON YOUR
                            KEYBOARD, OR CLOSE
                            THIS WINDOW.
                        </h4>
                    </div>

                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php
}

function main_footer()
{
    $ci = &get_instance();
    ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="https://gelomorancil.github.io/">Gelo</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
    </script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js">
    </script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/chart.js/Chart.min.js"></script>
    <!-- Sweetalert -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/toastr/toastr.min.js"></script>
    <!-- InputMask -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/moment/moment.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/select2/js/select2.full.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/chart.js/Chart.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
    </script>
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js">
    </script>
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js">
    </script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js">
    </script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js">
    </script>
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js">
    </script>
    <!-- bs-custom-file-input -->
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js">
    </script>
    <!-- ChartJS -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/chart.js/Chart.min.js"></script>
    <!-- load global js -->
    <script src="<?= base_url() ?>assets/js/global.js"></script>
    <!-- Ekko Lightbox -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Filterizr-->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- added js -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> -->
    <script src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/flot/jquery.flot.js"></script>

    <!-- <script src="<?= base_url() ?>assets/theme/html-version/scripts/app.js"></script> -->
    <script src="<?= base_url() ?>assets/js/noPostBack.js"></script>
    <script src="<?= base_url() ?>assets/js/service.js"></script>

    <!-- bootstrap color picker -->
    <script
        src="<?= base_url() ?>assets/theme/adminlte/AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js">
    </script>


    <script>
    var base_url = '<?= base_url() ?>';
    var baseUrl = '<?= base_url() ?>';

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    //Date range picker
    $('#reservation').daterangepicker()
    var base_url = <?php echo json_encode(base_url()) ?>;

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $('#signout').on('click', function() {
        window.location = base_url;
    })

    // $(function() {
    //     bsCustomFileInput.init();

    //     // the ol reliable idle signout
    //     $(document).on('mousemove keypress', function() {
    //         time = new Date().getTime(); //refreshes timer
    //     });

    //     function refresh() {
    //         // console.log("a:"+ time);
    //         if (new Date().getTime() - time == 200000) {
    //             $('#idle').modal('show');
    //             // console.log("modal");
    //             setTimeout(refresh, 1000);
    //         } else if (new Date().getTime() - time >= 300000) { //60000 = 1 min
    //             window.location = base_url + "login/authentication";
    //         } else {
    //             setTimeout(refresh, 1000);
    //         }
    //     }

    //     setTimeout(refresh, 1000); //initiates the recursion
    // });
    </script>
</body>

</html>
<?php
}
?>

<?php function load_table_css()
{ ?>
<script>
$(function() {
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // if ( $.fn.dataTable.isDataTable( '#tableformat1' ) ) {
    //   table = $('#tableformat1').DataTable();
    // }
    // else {
    //     table = $('#tableformat1').DataTable( {
    //         paging: true
    //         // retrieve: true,
    //     } );
    // }
});

$(function() {
    $("#example1").DataTable({
        "responsive": false,
        "lengthChange": false,
        "pageLength": 50,
        "autoWidth": false,
        "searching": false,
        "info": false,
        "retrieve": true,
        "ordering": false,
        // "buttons": ["excel"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
                label: 'Digital Goods',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [28, 48, 40, 19, 86, 27, 90]
            },
            {
                label: 'Electronics',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [65, 59, 80, 81, 56, 55, 40]
            },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = true;
    lineChartData.datasets[1].fill = true;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })
})
</script>
<?php } ?>