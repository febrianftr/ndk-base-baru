    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/sketch.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap4.min.js"></script>
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <script src="js/script.js"></script>
    <script src="navbar.js"></script>
    <script src="ckeditor/ckeditor.js?v=5"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
    <script src="../js/moment.min.js" />
    </script>
    <script src="../js/datetime-moment.js" />
    </script>


    <!-- =======menghapus border pada div======== -->
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('DD-MM-YYYY HH:mm');
            $(".table-dicom").removeAttr("border", "1");
        })
    </script>
    <!-- =======menghapus border pada div======== -->

    <script>
        $(document).ready(function() {
            $('#incfont').click(function() {
                curSize = parseInt($('.body').css('font-size')) + 1;
                if (curSize <= 20)
                    $('.body').css('font-size', curSize);
            });
            $('#decfont').click(function() {
                curSize = parseInt($('.body').css('font-size')) - 1;
                if (curSize >= 10)
                    $('.body').css('font-size', curSize);
            });
        });
    </script>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('.table-paginate').dataTable();
        });
    </script>

    <script>
        // untuk menampilkan data popup
        $(function() {
            $(document).on('click', '.hasil-all', function(e) {
                e.preventDefault();
                $("#modal-all").modal('show');
                $.post('../hasil-all.php', {
                        uid: $(this).attr('data-id')
                    },
                    function(html) {
                        $(".modal-body").html(html);
                    }
                );
            });
        });
        // end untuk menampilkan data popup
    </script>
    <script>
        // untuk menampilkan data popup
        $(function() {
            $(document).on('click', '.hasil-series', function(e) {
                e.preventDefault();
                $("#modal-series").modal('show');
                $.post('../hasil-series.php', {
                        uid: $(this).attr('data-id')
                    },
                    function(html) {
                        $(".modal-body").html(html);
                    }
                );
            });
        });
        // end untuk menampilkan data popup
    </script>
    <script>
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        }, false);
    </script>

    <script>
        $(document).ready(function() {
            $(".disokin").fadeOut();
        })
    </script>

    <script>
        if ($(window).width() < 1115) {
            $('#logout2').removeClass('logout1');
        }
    </script>