
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

<form method="post" action="<?php echo site_url('book/findbooks'); 

// arahkan form submit ke kontroller 'book/findbooks ?>">
<input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search" name="key" style="border: 1px solid #cccccc; margin-top: 20px;">
</form>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Kategori</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>Kategori</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        // menampilkan data buku
        foreach ($kategori as $kategori_item): 
        ?>
        <tr>
          <td><?php echo $kategori_item['kategori']?></td>
          <td>
           <?php echo anchor('kategori/edit/'.$kategori_item['idkategori'], 'Edit', 'Edit Kategori') ?> 
            | <?php echo anchor('kategori/delete/'.$kategori_item['idkategori'], 'Del', 'Hapus Kategori'); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
