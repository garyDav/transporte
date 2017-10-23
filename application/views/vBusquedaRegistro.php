<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Buscar Reserva</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form id="form" role="form" method="get">
                <div class="box-body">

                        <div class="form-group">
                            <label>
                                <input type="radio" id="campo" name="campo" class="minimal" value="proyecto"  checked>
                                Nombre del proyecto         
                            </label>

                        </div>
                    <div class="form-group">
                        <label for="nombre">Datos:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Datos a Buscar..." required>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" id="btnSearch" id="btnSearch" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div><!-- /.box -->

    <div class="box">
            <div class="box-body no-padding">
        
                <table id="resultTable" class="table table-striped">
                    
                </table>
            </div>
    </div>
    
   
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(document).ready(function (){
        $('#btnSearch').click(function(){
            makeAjaxRequest();
        });
        $("input#nombre").keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                makeAjaxRequest()
                return false;
            }
        });
        function makeAjaxRequest() {
            var parametros = {
                "name" : $('input#nombre').val(),
                "campo": $('input[name=campo]:checked','#form').val()
            };
            $.ajax({
                url: '<?php echo base_url()?>Busqueda/search',
                type: 'get',
                data: parametros,
                success: function(response) {
                    $('table#resultTable ').html(response);
                }
            });
        }

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>