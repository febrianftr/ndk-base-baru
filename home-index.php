<style type="text/css">
  .chart_index {
    background-color: #f7f7f7;
    padding: 10px;
    opacity: 0.9;
    border-radius: 0 0 5px 5px;
  }

  .footerindex {
    position: fixed;
  }
</style>
<meta http-equiv="refresh" content="600" />
<br>
<div class=" container-fluid ovrflow scroller-itwd">
  <div class="ovrflow">
    <table class="table-dicom" id="example" style="margin-top: 3px; width: 100px;" cellpadding="8" cellspacing="0">
      <thead class="thead1">
        <tr>
          <th>No</th>
          <th>Aksi</th>
          <th>Status</th>
          <th>No Foto</th>
          <th>MRN</th>
          <th>Nama</th>
          <th>Umur</th>
          <th>Jenis <br /> Kelamin</th>
          <th>Pemeriksaan <br /> Utama</th>
          <th>Modality</th>
          <th>Dokter <br /> Pengirim</th>
          <th>Poli</th>
          <th>Dokter <br /> Radiologi</th>
          <th>Nama <br /> Radiografer</th>
          <th>Selesai <br /> Pemeriksaan</th>
          <th>Selesai <br /> Dibaca</th>
          <th>Waktu <br /> Tunggu</th>
        </tr>
      </thead>
    </table>
    <!-- The Modal -->
    <div class="modal" id="modal-all">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <!-- <h1 class="modal-title">Modal Heading</h1> -->
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End The Modal -->
  </div>
</div>
<script src="js/3.1.1/jquery.min.js"></script>
<script>
  $('document').ready(function() {
    var table = $('#example').dataTable({
      "ajax": {
        "url": "../getAll.php",
        "dataSrc": ""
      },
      "columns": [{
          "data": "no"
        },
        {
          "data": "report"
        },
        {
          "data": "status"
        },
        {
          "data": "no_foto"
        },
        {
          "data": "mrn"
        },
        {
          "data": "pat_name"
        },
        {
          "data": "pat_birthdate"
        },
        {
          "data": "pat_sex"
        },
        {
          "data": "study_desc"
        },
        {
          "data": "mods_in_study"
        },
        {
          "data": "named"
        },
        {
          "data": "name_dep"
        },
        {
          "data": "dokrad_name"
        },
        {
          "data": "radiographer_name"
        },
        {
          "data": "updated_time"
        },
        {
          "data": "approve_date"
        },
        {
          "data": "spendtime"
        }
      ]
    });
  });
</script>