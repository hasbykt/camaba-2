<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CAMABA | Edit Materi</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="page-top">
    @if (session('success'))
    <script>
        Swal.fire({
            title: "Berhasil",
            text: "{{ session("
            success ")}}",
            icon: "success"
        });

    </script>
    @endif


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion nav-tabs" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-5" href="adminhome">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('storage/'.$user->foto_profile)}}" class="border rounded-circle my-2 bg-white"
                        width="60%">
                </div>
                <div class="sidebar-brand-text my-1">{{$user->username}}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Nav Item - Beranda -->
            <li class="nav-item">
                <a class="nav-link" href="daftaruser">
                    <i class="fas fa-user-alt text-light"></i>
                    <span>Daftar User</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tambah-materi">
                    <i class="fas fa-book-open text-light"></i>
                    <span>Tambah Materi</span></a>
            </li>

            <li class="nav-item active border rounded">
                <a class="nav-link" href="edit-materi">
                    <i class="fas fa-book-open text-light"></i>
                    <span>Edit Materi</span></a>
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
                        <h3 class="text-info mb-0">Edit Materi</h3>
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

                        <!--Tabel-->
                        <div class="col-md-12 text-dark">
                            <div class="card mb-3 justify-content-center">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-info text-center text-light">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">Jurusan</th>
                                                    <th scope="col">Mapel</th>
                                                    <th scope="col">Modul</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-dark text-center">
                                                @foreach($materis as $index => $materi)
                                                <tr>
                                                    <td scope="row">{{ $index + 1 }}</td>
                                                    <td>{{ $materi->kelas }}</td>
                                                    <td>{{ $materi->jurusan }}</td>
                                                    <td>{{ $materi->mapel }}</td>
                                                    <td>{{ $materi->modul }}</td>
                                                    <td>
                                                        <a href="{{ route('edit-materi-2', $materi->id) }}"
                                                            class="btn btn-info btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-info-circle"></i>
                                                            </span>
                                                            <span class="text">Edit</span>
                                                        </a>
                                                        <button class="btn btn-danger btn-icon-split btn-delete"
                                                            data-id="{{ $materi->id }}">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            <span class="text">Hapus</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
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

            <!-- Bootstrap core JavaScript-->
            <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
            <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

            <!-- Page level plugins -->
            <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
            <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.btn-delete').forEach(button => {
                        button.addEventListener('click', function () {
                            const materiId = this.dataset.id;
                            Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: "Materi ini akan dihapus!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, hapus!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch(`/materi/${materiId}`, {
                                            method: 'DELETE',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            Swal.fire(
                                                'Dihapus!',
                                                'Materi telah berhasil dihapus.',
                                                'success'
                                            ).then(() => {
                                                window.location
                                                    .reload(); // Reload halaman setelah sukses
                                            });
                                        })
                                        .catch(error => {
                                            Swal.fire(
                                                'Gagal!',
                                                'Materi gagal dihapus.',
                                                'error'
                                            );
                                        });
                                }
                            });
                        });
                    });
                });

            </script>


</body>

</html>
