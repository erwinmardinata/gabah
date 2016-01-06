<h3 align="center"><?php echo $nama->nama_sub_operasional; ?></h3>
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
