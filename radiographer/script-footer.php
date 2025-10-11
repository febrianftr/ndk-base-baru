<!--  <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/sketch.min.js"></script>
<script src="js/3.1.1/jquery.min.js"></script>
<!-- <script src="js/bootstrap.js"></script> -->
<script type="text/javascript" src="../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../js/bootstrap4.min.js"></script>
<script src="../radiology/ckeditor/ckeditor.js?v=<?= $random; ?>"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script src="js/script.js"></script>
<script src="js/chart.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.bootstrap4.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script> -->
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<script src="../js/moment.min.js" />
</script>
<script src="../js/datetime-moment.js" />
</script>
<script src="../js/inobitec.js?v=<?= $random; ?>"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js" />
</script>
<script type="text/javascript" src="../js/sweetalert.min.js" />
</script>
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
    $(".table-dicom").on("click", "tbody tr", function(event) {
        $(this).addClass("highlight").siblings().removeClass("highlight");
    });
</script>

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
            if (curSize <= 18)
                $('.body').css('font-size', curSize);
        });
        $('#decfont').click(function() {
            curSize = parseInt($('.body').css('font-size')) - 1;
            if (curSize >= 11)
                $('.body').css('font-size', curSize);
        });
    });
</script>



<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('.table-paginate').dataTable({
            responsive: true
        });
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
        $(document).on('click', '.hasil-waiting-morethanusgdoppler2hour', function(e) {
            e.preventDefault();
            $("#modal-waiting-morethanusgdoppler2hour").modal('show');
            $.post('../hasil-waiting-morethanusgdoppler2hour.php', {
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
        $(document).on('click', '.hasil-waiting-morethanusg1hour', function(e) {
            e.preventDefault();
            $("#modal-waiting-morethanusg1hour").modal('show');
            $.post('../hasil-waiting-morethanusg1hour.php', {
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
        $(document).on('click', '.hasil-waiting-morethanct6hour', function(e) {
            e.preventDefault();
            $("#modal-waiting-morethanct6hour").modal('show');
            $.post('../hasil-waiting-morethanct6hour.php', {
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
        $(document).on('click', '.hasil-waiting-morethancontrast6hour', function(e) {
            e.preventDefault();
            $("#modal-waiting-morethancontrast6hour").modal('show');
            $.post('../hasil-waiting-morethancontrast6hour.php', {
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
        $(document).on('click', '.hasil-waiting-morethan3hour', function(e) {
            e.preventDefault();
            $("#modal-waiting-morethan3hour").modal('show');
            $.post('../hasil-waiting-morethan3hour.php', {
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
        $(document).on('click', '.hasil-waiting-morethancito1hour', function(e) {
            e.preventDefault();
            $("#modal-waiting-morethancito1hour").modal('show');
            $.post('../hasil-waiting-morethancito1hour.php', {
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
        $(document).on('click', '.hasil-acc', function(e) {
            e.preventDefault();
            $("#modal-acc").modal('show');
            $.post('../hasil-acc.php', {
                    pat_id: $("#pat_id").val(),
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
    // untuk menampilkan data popup
    $(function() {
        $(document).on('click', '.edit-record', function(e) {
            e.preventDefault();
            $("#myModal").modal('show');
            $.post('hasil2.php', {
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
        $(document).on('click', '.order2', function(e) {
            e.preventDefault();
            $("#modal-order2").modal('show');
            $.post('hasil-order2.php', {
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
        $(document).on('click', '.hasil-move-image', function(e) {
            e.preventDefault();
            $("#modal-move-image").modal('show');
            $.post('hasil-move-image.php', {
                    pk_parent: $(this).attr('data-parent'),
                    pk_child: $(this).attr('data-child'),
                    study_iuid_parent: $(this).attr('data-study-iuid-parent'),
                    is_study_series: $(this).attr('data-is-move')
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
        $(document).on('click', '.hasil-copy-image', function(e) {
            e.preventDefault();
            $("#modal-copy-image").modal('show');
            $.post('hasil-copy-image.php', {
                    pk_parent: $(this).attr('data-parent'),
                    pk_child: $(this).attr('data-child'),
                    study_iuid_parent: $(this).attr('data-study-iuid-parent'),
                    is_study_series: $(this).attr('data-is-copy')
                },
                function(html) {
                    $(".modal-body").html(html);
                }
            );
        });
    });
    // end untuk menampilkan data popup
</script>
<!-- <script>
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    }, false);
</script> -->



<!-- <script>
        $(document).ready(function() {
            currLoc = $(location).attr('pathname');
            $('a[href="' + currLoc + '"]').addClass("active-menu");
        });
    </script> -->

<script>
    $(document).ready(function() {
        $(".disokin").fadeOut();
    })
</script>

<script>
    $(document).ready(function() {
        $(".dcm_button").click(function() {
            $(".disokin").addClass("displayBlok");
            $(".spinner").fadeIn();
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $(".pagination").addClass("modal-5");
    });
</script>


<!-- chat -->
<script>
    (function() {
        $(document).ready(function() {
            $("#live-chat").hide();
            $(".btn_chat2").click(function() {
                $("#live-chat").animate({
                    height: 'toggle'
                });
            });
        });


        $('#live-chat header').on('click', function() {
            // $('.chat').slideToggle(300, 'swing');
            // $('.chat-message-counter').fadeToggle(300, 'swing');
        });
        $('.chat-close').on('click', function(e) {
            e.preventDefault();
            $('#live-chat').fadeOut(300);
        });
    })();
</script>
<!-- chat -->


<script>
    if ($(window).width() < 1115) {
        $('#logout2').removeClass('logout1');
    }
</script>






<!-- ---------SIDE BAR NEW--------------------- -->
<script>
    if ($(window).width() < 1200) {
        $('.sidebarnew').addClass('closenew');
    }

    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    let sidebarnew = document.querySelector(".sidebarnew");
    let sidebarBtn = document.querySelector(".fa-stream");
    // sidebarBtn.addEventListener("click", () => {
    //     sidebarnew.classList.toggle("closenew");
    // });
</script>
<!-- ---------END SIDE BAR NEW--------------------- -->

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
    function copyText(e, study_iuid) {
        e.preventDefault();
        swal({
            title: 'Copy',
            text: 'Link Has been Copied',
            icon: "success",
            timer: 1500,
        }).then(function() {
            const textarea = document.createElement('textarea');
            textarea.value = study_iuid;
            // Move the textarea outside the viewport to make it invisible
            textarea.style.position = 'absolute';
            textarea.style.left = '-99999999px';
            document.body.prepend(textarea);
            // highlight the content of the textarea element
            textarea.select();
            document.execCommand('copy');
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