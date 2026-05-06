            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>

  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="vendor/datatables/dataTables.responsive.min.js"></script>
  <script src="vendor/datatables/responsive.bootstrap4.min.js"></script>
  <script src="vendor/datatables/dataTables.buttons.min.js"></script>
  <script src="vendor/datatables/buttons.bootstrap4.min.js"></script>
  <script src="vendor/datatables/jszip.min.js"></script>
  <script src="vendor/datatables/pdfmake.min.js"></script>
  <script src="vendor/datatables/vfs_fonts.js"></script>
  <script src="vendor/datatables/buttons.html5.min.js"></script>
  <script src="vendor/datatables/buttons.print.min.js"></script>
  <script src="vendor/datatables/buttons.colVis.min.js"></script>

  <script src="fullcalendar/lib/moment.min.js"></script>
  <script src="fullcalendar/fullcalendar.min.js"></script>
  <script src="js/croppie.js"></script>

    <script type="text/javascript">

        <?php
        $Treatment = mysqli_query($db, "SELECT * FROM illness_patients WHERE conditions='Treatment'");
        $Cured = mysqli_query($db, "SELECT * FROM illness_patients WHERE conditions='Cured'");
        $rowilt=mysqli_num_rows($Treatment);
        $rowCured=mysqli_num_rows($Cured);
        ?>
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");

        var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Under Treatment", "Cured"],
            datasets: [{
            data: [<?php echo $rowilt; ?>, <?php echo $rowCured; ?>],
            backgroundColor: ['#4e73df', '#1cc88a'],
            hoverBackgroundColor: ['#2e59d9', '#17a673'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            },
            legend: {
            display: false
            },
            cutoutPercentage: 80,
        },
        });
    </script>

  <script type="text/javascript">
    $(function () {
      $(".btnPrint").click(function () {
          var contents = $("#dvContents").html();
          var frame1 = $('<iframe />');
          frame1[0].name = "frame1";
          frame1.css({ "position": "absolute", "top": "-1000000px" });
          $("body").append(frame1);
          var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
          frameDoc.document.open();
          //Create a new HTML document.
          frameDoc.document.write('<html><head><title>DIV Contents</title>');
          frameDoc.document.write('</head><body>');
          //Append the external CSS file.
          frameDoc.document.write('<link href="css/style.css" rel="stylesheet" type="text/css" />');
          //Append the DIV contents.
          frameDoc.document.write(contents);
          frameDoc.document.write('</body></html>');
          frameDoc.document.close();
          setTimeout(function () {
              window.frames["frame1"].focus();
              window.frames["frame1"].print();
              frame1.remove();
          }, 500);
      });
    });

    $(document).ready(function() {
        $('#dataTable').DataTable();
    $('#idtable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'excel', 'pdf', 'print'
        ]
    } );
});
  </script>
  <script>

$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "fetch-event.php",
        displayEventTime: true,
        timeFormat: 'h:mm',
        displayEventEnd: true,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },

    });
});
</script>

<script>  
    $(document).ready(function(){
        $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
        width:200,
        height:200,
        type:'circle'
        },
        boundary:{
        width:300,
        height:300
        }    
        });
    $('#before_crop_image').on('change', function(){

        var reader = new FileReader();
        reader.onload = function (event) {
        $image_crop.croppie('bind', {
        url: event.target.result
        }).then(function(){
        console.log('jQuery bind complete');
        });
        }
        reader.readAsDataURL(this.files[0]);
        $('#imageModel').modal('show');
    });
    
    $('.crop_image').click(function(event){
        $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
        }).then(function(response){
            $.ajax({
            url:'Uploadhealthprofile.php',
            type:'POST',
            data:{"image":response},
                success:function(data){
                $('#imageModel').modal('hide');
                }
            });
        });
    });
    });  
</script>
</body>
</html>