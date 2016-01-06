<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo $nama->nama_sub_operasional; ?></h3>
    </div>
    <div class="panel-body">
      <button onclick="location.href='<?php echo site_url("gudanggabah/export/".$nama->id); ?>'" class="btn btn-default" style="float: right; margin-bottom: 12px;">Export Excel</button>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>No. Bukti</th>
            <th>Keterangan</th>
            <th>Berkurang</th>
            <th>Bertambah</th>
          </tr>
        </thead>
        <tbody>
        <?php if($laporan == null) { ?>
          <tr>
            <td colspan="6" align="center"> - Data Kosong - </td>
          </tr>
        <?php
          } else {
          $x=1; $total=0; foreach($laporan as $row):
        ?>
          <tr>
            <td><?php echo $x; ?></td>
            <td><?php echo $row->tanggal; ?></td>
            <td><?php echo $row->kode_transaksi; ?></td>
            <td><?php echo ' - '; ?></td>
            <td><?php echo $row->status==0?$row->nominal:'-'; ?></td>
            <td><?php echo $row->status==1?$row->nominal:'-'; ?></td>
          </tr>
        <?php $x++; endforeach; } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  </div>
</div>
