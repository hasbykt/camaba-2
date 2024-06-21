<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CAMABA | Video-2</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion nav-tabs" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-5" href="homepage">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('storage/'.$user->foto_profile)}}" class="border rounded-circle my-2" width="60%">
                </div>
                <div class="sidebar-brand-text my-1">{{ $user->username }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Nav Item - Beranda -->
            <li class="nav-item">
                <a class="nav-link" href="profil">
                    <i class="fas fa-user-graduate text-light"></i>
                    <span>Profil</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="materi">
                    <i class="fas fa-book-open text-light"></i>
                    <span>Materi</span></a>
            </li>

            <li class="nav-item active border rounded">
                <a class="nav-link" href="video">
                    <i class="fas fa-caret-square-right text-light"></i>
                    <span>Video</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="quiz">
                    <i class="fas fa-question text-light"></i>
                    <span>Quiz</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="faq">
                    <i class="fas fa-comments text-light"></i>
                    <span>FAQ</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Logout -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="#modal-logout" data-toggle="modal">
                    <i class="fas fa-sign-out-alt text-light"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 text-info">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Back Button-->
                    <div class="d-flex align-items-center">
                        <a href="javascript:history.back()">
                            <i class="fas fa-angle-left fa-2x text-info"></i>
                        </a>
                    </div>

                    <!-- Judul Page -->
                    <div class="flex-grow-1 text-center">
                        <h3 class="text-info mb-0">{{ $materi[0]->kelas }} - {{ $materi[0]->jurusan }}</h3>
                    </div>

                    <!-- Image -->
                    <div class="ml-auto">
                        <img src="img/thank-removebg-preview-4-WsB.png" width="55px">
                    </div>
                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <div id="accordion" class="myaccordion">
                            @php
                            $groupedMateri = $materi->groupBy('mapel');
                            @endphp

                            @foreach($groupedMateri as $mapel => $items)
                            <div class="card">
                                <div class="card-header" id="heading{{ $loop->index }}">
                                    <h2 class="mb-0">
                                        <button
                                            class="d-flex align-items-center justify-content-between btn btn-link collapsed"
                                            data-toggle="collapse" data-target="#collapse{{ $loop->index }}"
                                            aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                            {{ $mapel }}
                                            <span class="fa-stack fa-sm">
                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                <i class="fa fa-angle-right fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{ $loop->index }}" class="collapse"
                                    aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion">
                                    @foreach($items as $item)
                                    <a href="{{ route('video-3', ['modul' => $item->modul]) }}">
                                        <div class="card-body border text-center py-2 text-info">
                                            {{ $item->modul }}
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CAMABA 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!--modal Log Out-->
            <div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <h1 class="">Logout Account</h1>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="panel-body">
                                            Jika anda keluar akun maka anda harus login ulang untuk masuk,
                                            Apakah anda yakin untuk keluar akun?
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                <a href="login" class="btn btn-danger" type="submit">
                                    Ya, Keluar!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .myaccordion {
                    width: 100%;
                    margin: auto;
                    box-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
                }

                .myaccordion .card,
                .myaccordion .card:last-child .card-header {
                    border: none;
                }

                .myaccordion .card-header {
                    border-bottom-color: #EDEFF0;
                    background: transparent;
                }

                .myaccordion .fa-stack {
                    font-size: 18px;
                }

                .myaccordion .btn {
                    width: 100%;
                    font-weight: bold;
                    color: #36b9cc;
                    padding: 0;
                }

                .myaccordion .btn-link:hover,
                .myaccordion .btn-link:focus {
                    text-decoration: none;
                }

            </style>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>



            <script>
                $('#accordion').on('hide.bs.collapse show.bs.collapse', function (e) {
                    $(e.target)
                    .prev('.card-header')
                    .find('i.fa')
                    .toggleClass('fa-angle-right fa-angle-down');
                });
            </script>

</body>

</html>
