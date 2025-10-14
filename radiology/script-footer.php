<script src="js/jquery-3.3.1.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- <script src="js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="js/sketch.min.js"></script>
<script src="ckeditor/ckeditor.js?v=<?= $random; ?>"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script src="../js/bootstrap4.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script src="js/script.js"></script>
<!-- <script src="navbar.js"></script> -->
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="../js/moment.min.js" />
</script>
<script type="text/javascript" src="../js/jquery.validate.min.js" />
</script>
<script type="text/javascript" src="../js/sweetalert.min.js" />
</script>
<script type="text/javascript" src="../js/datetime-moment.js" />
</script>
<script type="text/javascript" src="../js/inobitec.js?v=<?= $random; ?>"></script>
<script type="text/javascript" src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/change-doctor-approved.js?v=<?= $random; ?>"></script>

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
        $(".services").click(function() {
            $(".services-arrow").toggleClass('flip1');
        });

        $(".products1").click(function() {
            $(".products1-arrow").toggleClass('flip2');
        });
    });
</script>


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

<script>
    $(".table-dicom").on("click", "tbody tr", function(event) {
        $(this).addClass("highlight").siblings().removeClass("highlight");
    });
</script>

<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".myTable").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
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
    // untuk menampilkan data popup
    $(function() {
        $(document).on('click', '.hasil-radiographer', function(e) {
            e.preventDefault();
            $("#modal-radiographer").modal('show');
            $.post('../hasil-radiographer.php', {
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
        $(document).on('click', '.view-template', function(e) {
            e.preventDefault();
            $("#view-template").modal('show');
            $.post('../hasil-template.php', {
                    template_id: $(this).attr('data-id')
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
    // untuk menampilkan data popup history expertise
    $(function() {
        $(document).on('click', '.view-history-expertise', function(e) {
            e.preventDefault();
            $("#view-history-expertise").modal('show');
            $.post('../hasil-history-expertise.php', {
                    study_iuid: $(this).attr('data-id')
                },
                function(html) {
                    $(".modal-body").html(html);
                }
            );
        });
    });
    // end untuk menampilkan data popup history expertise
</script>
<!-- <script>
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        }, false);
</script> -->


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

<script>
    const container = document.querySelector('.scroller-itwd , .table-box , .back-search');

    let startY;
    let startX;
    let scrollLeft;
    let scrollTop;
    let isDown;

    container.addEventListener('mousedown', e => mouseIsDown(e));
    container.addEventListener('mouseup', e => mouseUp(e))
    container.addEventListener('mouseleave', e => mouseLeave(e));
    container.addEventListener('mousemove', e => mouseMove(e));

    function mouseIsDown(e) {
        isDown = true;
        startY = e.pageY - container.offsetTop;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
        scrollTop = container.scrollTop;
    }

    function mouseUp(e) {
        isDown = false;
    }

    function mouseLeave(e) {
        isDown = false;
    }

    function mouseMove(e) {
        if (isDown) {
            e.preventDefault();
            //Move vertcally
            const y = e.pageY - container.offsetTop;
            const walkY = y - startY;
            container.scrollTop = scrollTop - walkY;

            //Move Horizontally
            const x = e.pageX - container.offsetLeft;
            const walkX = x - startX;
            container.scrollLeft = scrollLeft - walkX;

        }
    }
</script>
<script>
    function validationDokter(e, dokrad_fullname) {
        e.preventDefault();
        swal({
            title: 'Validation',
            text: 'Bukan pasien dokter ' + dokrad_fullname,
            icon: "error",
            timer: 1500,
        });
    }
</script>

<!-- new-sidebar -->
<script>
    $(function() {
        // submenu toggle
        $(".menu-item1").on("click", function(e) {
            // prevent closing sidebar when clicking submenu
            e.stopPropagation();
            $(this).find(".submenu1").slideToggle(180);
            $(this).find(".fa-chevron-down").toggleClass("rotate1");
        });

        // toggle sidebar behaviour (desktop vs mobile)
        $("#sidebarToggle").on("click", function(e) {
            e.stopPropagation();
            var $btn = $(this);
            var $sidebar = $("#sidebar1");
            var $content = $("#content2");
            var isMobile = $(window).width() <= 768;

            if (isMobile) {
                // mobile: toggle active1 on sidebar, toggle open1 on button
                $sidebar.toggleClass("active1");
                $btn.toggleClass("open1");
            } else {
                // desktop: toggle collapsed1 and content full state
                $sidebar.toggleClass("collapsed1");
                $content.toggleClass("full1");
                $btn.toggleClass("collapsed1");
            }
        });

        // click outside to close sidebar on mobile
        $(document).on("click", function(e) {
            var isMobile = $(window).width() <= 768;
            if (!isMobile) return;

            var $sidebar = $("#sidebar1");
            var $btn = $("#sidebarToggle");

            if ($sidebar.hasClass("active1")) {
                // if click target is outside sidebar and not toggle button -> close
                if ($(e.target).closest("#sidebar1").length === 0 && $(e.target).closest("#sidebarToggle").length === 0) {
                    $sidebar.removeClass("active1");
                    $btn.removeClass("open1");
                }
            }
        });

        // on resize, reset conflicting classes so behaviour stays consistent
        $(window).on("resize", function() {
            if ($(window).width() > 768) {
                // leave desktop behaviour: remove mobile-only classes
                $("#sidebar1").removeClass("active1");
                $("#sidebarToggle").removeClass("open1");
            } else {
                // entering mobile: remove desktop collapsed states to avoid left:-250 stuck
                $("#sidebar1").removeClass("collapsed1");
                $("#content2").removeClass("full1");
                $("#sidebarToggle").removeClass("collapsed1");
            }
        });
    });

    // Fungsi pencarian menu dan submenu
    $('#searchMenu1').on('keyup', function() {
        var keyword = $(this).val().toLowerCase();

        $('.menu-item1, .submenu1 a').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
        });

        // Sembunyikan grup menu yang kosong
        $('.menu-group1').each(function() {
            var hasVisibleItems = $(this).find('.menu-item1:visible, .submenu1 a:visible').length > 0;
            $(this).toggle(hasVisibleItems);
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Toggle dropdown visibility
        $('#filterToggle1').click(function(e) {
            e.stopPropagation();
            $('#filterDropdown1').toggle();
        });

        // Close dropdown when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('#filterDropdown1, #filterToggle1').length) {
                $('#filterDropdown1').hide();
            }
        });

        // Search filter inside dropdown
        $('#searchZones1').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.checkbox-list1 label').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // --- Auto manage show/hide and View All button ---
        let zoneLabels = $('.checkbox-list1 .zone-check1').parent('label');
        let viewAllBtn = $('#viewAll1');

        // Jika lebih dari 4 zone, sembunyikan sisanya dan tampilkan tombol view all
        if (zoneLabels.length > 4) {
            zoneLabels.slice(4).hide();
            viewAllBtn.show();
        }

        // Toggle tampil semua / sembunyi
        viewAllBtn.on('click', function(e) {
            e.preventDefault();
            let hidden = zoneLabels.slice(4).is(':hidden');
            zoneLabels.slice(4).slideToggle(200);
            $(this).text(hidden ? 'View less...' : 'View all...');
        });


        // ✅ Check All Functionality
        $('#checkAll1').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.zone-check1').prop('checked', isChecked);
        });

        // ✅ Update Check All dynamically
        $(document).on('change', '.zone-check1', function() {
            const allZones = $('.zone-check1').length;
            const checkedZones = $('.zone-check1:checked').length;
            $('#checkAll1').prop('checked', allZones === checkedZones);
        });

        function updateFilterPreview() {
            const previewContainer = $('#selectedZonesPreview1');
            previewContainer.empty();

            // === 1. Date range preview ===
            const fromDate = $('#from_study_datetime').val();
            const toDate = $('#to_study_datetime').val();

            if (fromDate || toDate) {
                let dateText = '';
                if (fromDate && toDate) {
                    dateText = `${fromDate} → ${toDate}`;
                } else if (fromDate) {
                    dateText = `From: ${fromDate}`;
                } else {
                    dateText = `To: ${toDate}`;
                }

                previewContainer.append(`
    <span class="zone-tag1" data-type="date">
      ${dateText} <span class="remove-filter1" data-target="date">&times;</span>
    </span>
  `);
            }

            // === 2. Input text preview (example: Name, MRN, No Foto) ===
            $('.filter-input1').each(function() {
                const val = $(this).val().trim();
                const label = $(this).attr('placeholder') || $(this).attr('name');
                if (val) {
                    previewContainer.append(`
        <span class="zone-tag1" data-type="text" data-target="#${this.id}">
          ${label}: ${val} <span class="remove-filter1">&times;</span>
        </span>
      `);
                }
            });

            // === 3. Modality (Zone) preview ===
            const selectedZones = $('.zone-check1:checked')
                .map(function() {
                    return $(this).val();
                })
                .get();

            selectedZones.forEach(zone => {
                previewContainer.append(`
      <span class="zone-tag1" data-type="zone" data-zone="${zone}">
        ${zone} <span class="remove-filter1">&times;</span>
      </span>
    `);
            });
        }

        // Event hapus chip filter
        $(document).on('click', '.remove-filter1', function() {
            const chip = $(this).parent('.zone-tag1');
            const type = chip.data('type');

            // 🧹 Hapus filter berdasarkan tipe chip
            if (type === 'zone') {
                const zoneName = chip.data('zone');
                $('.zone-check1').filter(function() {
                    return $(this).val() === zoneName;
                }).prop('checked', false);
            } else if (type === 'date') {
                $('#from_study_datetime, #to_study_datetime').val('');
            } else if (type === 'text') {
                const target = chip.data('target');
                $(target).val('');
            }

            // 🧩 Perbarui status Check All
            const allZones = $('.zone-check1').length;
            const checkedZones = $('.zone-check1:checked').length;
            $('#checkAll1').prop('checked', allZones === checkedZones);

            // 🔄 Refresh tampilan chip preview
            updateFilterPreview();
        });


        // === Event realtime update ===
        // Update preview secara realtime
        $(document).on('input change blur', '.filter-input1, #from_study_datetime, #to_study_datetime, .zone-check1, #checkAll1', function() {
            updateFilterPreview();
        });


        updateFilterPreview();

    });
</script>