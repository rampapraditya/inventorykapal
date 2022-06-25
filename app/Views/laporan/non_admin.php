<script type="text/javascript">

    $(document).ready(function () {
        show_tab();
    });
    
    function show_tab(){
        var form_data = new FormData();
        $.ajax({
            url: "<?php echo base_url(); ?>/lapstoknadm/ajax_load_table",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (data) {
                $('#wadah_tab').html(data.hasil);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert("Error json " + errorThrown);
            }
        });
    }

</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">LAPORAN STOK</h4>
                </div>
                <div class="card-body">
                    <div id="wadah_tab" class="col-md-12">
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>