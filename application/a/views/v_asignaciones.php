<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
    
 <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $reserva[0]->nombre;?>
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
      </div>
      <!-- /.row -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" onclick="add_maquina()" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Añadir Maquina
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
              <th>NOMBRE MAQUINA</th>
              <th>PESO UNITARIO</th>
              <th style="width:160px;">Accion</th>
            </tr>
            </thead>
            <tbody>
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
<script>
    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      var id_reserva = <?php echo $reserva[0]->id_reserva;?> ;
      //alert(id_proyecto);
      table = $('#tabla').DataTable({ 
        "searching":false,
        "paging":false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Asignaciones/ajax_list')?>/?id_reserva="+id_reserva,
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
      });


             $('.datepicker').datepicker({
              autoclose: true,
              format: "yyyy-mm-dd",
              todayHighlight: true,
              orientation: "top auto",
              todayBtn: true,
              todayHighlight: true,  
              });


    });


    function add_maquina()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Añadir Maquina'); // Set Title to Bootstrap modal title
    }


     function edit_maquina(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo base_url('Asignaciones/ajax_edit');?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id_maquinaria_reserva"]').val(data.id_maquinaria_reserva);
                $('#id_maquinaria').val(data.id_maquinaria);
                $('[name="id_reserva"]').val(data.id_reserva);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar Maquina'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

     function save()
    {
        $('#btnSave').text('guardando...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        if(save_method == 'add') {
                url = "<?php echo base_url('Asignaciones/ajax_add');?>";
        } else {
            url = "<?php echo base_url('Asignaciones/ajax_update');?>";
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
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('guardar'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('guardar'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }

     function delete_maquina(id)
    {
        if(confirm('Esta seguro de eliminar la Maquina?'))
        {
            // ajax delete data to database
            $.ajax({
                
                url : "<?php echo base_url('Asignaciones/ajax_delete');?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>

 <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario </h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <div class="form-body">
            <div class="form-group">
              <div class="col-md-9">
                <input name="id_maquinaria_reserva" type="hidden" class="form-control" value="">
                <input name="id_reserva" type="hidden" class="form-control" value="<?php echo $reserva[0]->id_reserva;?>">
               
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Maquina</label>
              <div class="col-md-9">
                <select name='id_maquinaria' id="id_maquinaria"  class="form-control" >
                 <?php foreach($maquina as $e){ ?>
                    <option value="<?php echo  $e->id_maquinaria?>"><?php echo  $e->nombre?></option>
                  <?php } ?>        
                </select>

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
