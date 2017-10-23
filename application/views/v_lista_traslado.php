<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">DETALLE DE TRASLADOS PROGRAMADOS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th>Nro.</th>
                  <th>NOMBRE PROYECTO</th>
                  <th>ORIGEN</th>
                  <th>DESTINO</th>
                  <th>FECHA INICIO</th>
                  <th>FECHA FIN</th>
                  <th>ESTADO</th>
                  <th>Costo Total</th>
                  <th>ACCION</th>
                  <th>PDF</th>
                </tr>
        <tbody>
          <?php echo $lista?>
        </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

