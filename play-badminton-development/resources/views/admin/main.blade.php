<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Badminton Club</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('backend/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <!-- Toaster CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Fonts and icons -->
    <script src="{{ asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>

    {{-- web font js --}}
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('backend/assets/css/fonts.min.css') }}"]

            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/kaiadmin.min.css') }}" />
    @yield('style')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('backend/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                @include('admin.layouts.navbar')
                <!-- End Navbar -->
            </div>

            @yield('content')

            {{-- @include('admin.layouts.footer') --}}
        </div>
    </div>
    <!--   Toaster JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.js"></script>

    @yield('script')
    <!--   Core JS Files   -->
    {{-- <script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script> //This file effects badly on event page --}}
    <script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/chart.js/chart.min.js') }}"></script> --}}

    <!-- jQuery Sparkline -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script> --}}

    <!-- Chart Circle -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/chart-circle/circles.min.js') }}"></script> --}}

    <!-- Bootstrap Notify -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}

    <!-- jQuery Vector Maps -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/assets/js/plugin/jsvectormap/world.js') }}"></script> --}}

    <!-- Sweet Alert -->
    <script src="{{ asset('backend/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('backend/assets/js/kaiadmin.min.js') }}"></script>

    {{-- <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script> --}}

    {{-- sweet alert on player delete --}}
    <script>
        var SweetAlert2Demo = (function() {
            var initDemos = function() {
                document.querySelectorAll(".delete_alert_player").forEach(function(button) {
                    button.addEventListener("click", function(e) {
                        e.preventDefault();
                        const playerId = button.getAttribute("data-player-id");
                        const form = document.getElementById(`delete-player-${playerId}`);

                        swal({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            buttons: {
                                cancel: {
                                    visible: true,
                                    text: "No, cancel!",
                                    className: "btn btn-success",
                                },
                                confirm: {
                                    text: "Yes, delete it!",
                                    className: "btn btn-danger",
                                },
                            },
                        }).then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            } else {
                                swal("Your player is safe!", {
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });
                            }
                        });
                    });
                });
            };

            return {
                init: function() {
                    initDemos();
                },
            };
        })();

        SweetAlert2Demo.init();
    </script>

    {{-- sweet alert on team delete --}}
    <script>
        var SweetAlert2Demo = (function() {
            var initDemos = function() {
                document.querySelectorAll(".delete_alert_team").forEach(function(button) {
                    button.addEventListener("click", function(e) {
                        e.preventDefault();
                        const teamId = button.getAttribute("data-team-id");
                        const form = document.getElementById(`delete-team-${teamId}`);

                        swal({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            buttons: {
                                cancel: {
                                    visible: true,
                                    text: "No, cancel!",
                                    className: "btn btn-success",
                                },
                                confirm: {
                                    text: "Yes, delete it!",
                                    className: "btn btn-danger",
                                },
                            },
                        }).then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            } else {
                                swal("Your team is safe!", {
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });
                            }
                        });
                    });
                });
            };

            return {
                init: function() {
                    initDemos();
                },
            };
        })();

        SweetAlert2Demo.init();
    </script>

    {{-- sweet alert on event delete --}}
    <script>
        var SweetAlert2Demo = (function() {
            var initDemos = function() {
                document.querySelectorAll(".delete_alert_event").forEach(function(button) {
                    button.addEventListener("click", function(e) {
                        e.preventDefault();
                        const eventId = button.getAttribute("data-event-id");
                        const form = document.getElementById(`delete-event-${eventId}`);

                        swal({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            buttons: {
                                cancel: {
                                    visible: true,
                                    text: "No, cancel!",
                                    className: "btn btn-success",
                                },
                                confirm: {
                                    text: "Yes, delete it!",
                                    className: "btn btn-danger",
                                },
                            },
                        }).then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            } else {
                                swal("Your event is safe!", {
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });
                            }
                        });
                    });
                });
            };

            return {
                init: function() {
                    initDemos();
                },
            };
        })();

        SweetAlert2Demo.init();
    </script>

    {{-- sweet alert on match delete --}}
    <script>
        var SweetAlert2Demo = (function() {
            var initDemos = function() {
                document.querySelectorAll(".delete_alert_match").forEach(function(button) {
                    button.addEventListener("click", function(e) {
                        e.preventDefault();
                        const matchId = button.getAttribute("data-match-id");
                        const form = document.getElementById(`delete-match-${matchId}`);

                        swal({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            buttons: {
                                cancel: {
                                    visible: true,
                                    text: "No, cancel!",
                                    className: "btn btn-success",
                                },
                                confirm: {
                                    text: "Yes, delete it!",
                                    className: "btn btn-danger",
                                },
                            },
                        }).then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            } else {
                                swal("Your match is safe!", {
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });
                            }
                        });
                    });
                });
            };

            return {
                init: function() {
                    initDemos();
                },
            };
        })();

        SweetAlert2Demo.init();
    </script>

    {{-- sweet alert on result delete --}}
    <script>
        var SweetAlert2Demo = (function() {
            var initDemos = function() {
                document.querySelectorAll(".delete_alert_result").forEach(function(button) {
                    button.addEventListener("click", function(e) {
                        e.preventDefault();
                        const resultId = button.getAttribute("data-result-id");
                        const form = document.getElementById(`delete-result-${resultId}`);

                        swal({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            buttons: {
                                cancel: {
                                    visible: true,
                                    text: "No, cancel!",
                                    className: "btn btn-success",
                                },
                                confirm: {
                                    text: "Yes, delete it!",
                                    className: "btn btn-danger",
                                },
                            },
                        }).then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            } else {
                                swal("Your result is safe!", {
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });
                            }
                        });
                    });
                });
            };

            return {
                init: function() {
                    initDemos();
                },
            };
        })();

        SweetAlert2Demo.init();
    </script>

    {{-- Toaster --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toastMessage = "{{ session('success') }}";
                if (toastMessage) {
                    Toastify({
                        text: toastMessage,
                        duration: 5000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        close: true,
                        icon: "fa fa-check-circle",
                        style: {
                            borderRadius: "10px",
                            boxShadow: "0 4px 6px rgba(0, 0, 0, 0.1)",
                            fontSize: "16px",
                            padding: "10px 20px",
                            color: "#fff",
                        },
                        onClick: function() {
                            Toastify().hideToast();
                        }
                    }).showToast();
                }
            });
        </script>
    @endif


</body>

</html>
