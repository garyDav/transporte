<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
    
 <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Detalle de la Empresa 
            <small class="pull-right">Hoy: <?php echo date('d m Y')?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Sr.(a) <?php echo $_SESSION['nombre_completo'] ?>
          <address>
            <strong>REPRESENTANTE LEGAL</strong><br>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          </br>

        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" onclick="add_reserva()" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Añadir Reserva
          </button>

        </div>
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="tabla" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>NOMBRE DEL PROYECTO</th>
              <th>DESTINO</th>
              <th>ESTADO</th>
              <th style="width:160px;">Accion</th>
            </tr>
            </thead>
            <tbody> 
            <?php echo $lista?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
    </section>


</div><!-- /.content-wrapper -->



<script type="text/javascript">

    var save_method; //for save method string
    var table;



    function add_reserva()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="id_persona"]').attr('disabled',false);
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Añadir Reserva'); // Set Title to Bootstrap modal title
    }

    function edit(id)
    {
      save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo base_url('Reserva/ajax_edit');?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_reserva"]').val(data.id_reserva);
                $('[name="fecha"]').val(data.fecha);
                $('[name="nombre"]').val(data.nombre);
                $('[name="destino"]').val(data.destino);
                 $('#estado').val(data.estado);

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar Reserva'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function save()
    {
        $('#btnSave').text('guardando...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        if(save_method == 'add') {
                url = "<?php echo base_url('Reserva/ajax_add');?>";
        } else {
            url = "<?php echo base_url('Reserva/ajax_update');?>";
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                     window.location.href='<?php echo base_url() ?>Reserva/index';
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Guardar'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('Guardar'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }

  
</script>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-9">
                                <input name="id_reserva" type="hidden" value="" >
                                <span class="help-block"></span>
                                <!-- datos que se recuperan de BD pero estan ocultas-->
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombre Proyecto</label>
                            <div class="col-md-9">
                                <input name="nombre" placeholder="Nombre del proyecto" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Estado</label>
                            <div class="col-md-9">
                                <select name='estado' id="estado"  class="form-control " >
                                  <option  value="1">Activo</option>
                                  <option  value="2">Inactivo</option>
                                </select>
                                
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Destino</label>
                            <div class="col-md-9">
                                <input name="destino" placeholder="Lugar de destino" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->