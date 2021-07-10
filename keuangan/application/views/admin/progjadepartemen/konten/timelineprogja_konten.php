<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Timeline Program Kerja
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Awal</a></li>
      <li class="active">Timeline Program Kerja</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Lihat Timeline</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x:auto;">
        <form method="GET " action="<?php echo base_url(); ?>departemen/timelineprogja/lihat/">
          <div class='form-group'>
                <label class='col-sm-1 control-label'>Departemen :</label>
                  <div class='col-sm-3'>
                    <select name='id' class='form-control' required>
                      <option value='-' selected>- Pilih Departemen -</option>";
                        <?php foreach($keu_departemen as $r):?>
                          <option value="<?=$r->id_departemen?>"><?=$r->nama_departemen?></option>";
                        <?php endforeach; ?>
                    </select>
                  </div>
                <div class='col-sm-3'>
                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button>
                </div>

          </div>
        </div>

          </div>

        </form>

              </div>

      </div>
    </div>
  </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

      </table>
        </form>
  	  </div>
  	</div>
    </div>
  </div>
  <!-- END Modal Edut Departemen -->



  </div>
</div>








  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
