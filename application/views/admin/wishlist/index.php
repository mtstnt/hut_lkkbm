
<div class="content-wrapper px-4">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Wishlist List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
        <?php $this->view('layout/admin/flash') ?>

            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <th><input id="check_all" type="checkbox"></th>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Wishlist</th>
                            <th>NRP</th>
                            <th>Jurusan</th>
                        </thead>
                        <tbody>
                            <?php foreach ($wishlist as $wish) : ?>
                            <tr>
                                <td><input type="checkbox" name="row-check" value="<?php echo $wish->id;?>"></td>
                                <td><?= $counter++ ?></td>
                                <td><?= $wish->nama ?></td>
                                <td><?= $wish->content ?></td>
                                <td><?= $wish->nrp ?></td>
                                <td><?= $wish->jurusan ?></td>
                                <td>
                                    <!-- belum selesai -->
                                    <a href="<?= base_url() ?>admin/wishlist/delete/<?= $wish->id ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- belum selesai -->
                    <div id="msg"></div>
                    <div class="button"><button id="delete_selected" class ="btn btn-danger delete">Delete Selected Row(s)</button></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function() {
	//If check_all checked then check all table rows
	$("#check_all").on("click", function () {
		if ($("input:checkbox").prop("checked")) {
			$("input:checkbox[name='row-check']").prop("checked", true);
		} else {
			$("input:checkbox[name='row-check']").prop("checked", false);
		}
	});

	// Check each table row checkbox
	$("input:checkbox[name='row-check']").on("change", function () {
		var total_check_boxes = $("input:checkbox[name='row-check']").length;
		var total_checked_boxes = $("input:checkbox[name='row-check']:checked").length;

		// If all checked manually then check check_all checkbox
		if (total_check_boxes === total_checked_boxes) {
			$("#check_all").prop("checked", true);
		}
		else {
			$("#check_all").prop("checked", false);
		}
	});
	
	$("#delete_selected").on("click", function () {
		var ids = '';
		var comma = '';
		$("input:checkbox[name='row-check']:checked").each(function() {
			ids = ids + comma + this.value;
			comma = ',';			
		});		
		
		if(ids.length > 0) {
			$.ajax({
				type: "POST",
				url: "http://bem.petra.ac.id/hut_lkkbm/admin/wishlist/deleteAll",
				data: {'ids': ids},
				dataType: "html",
				cache: false,
				success: function(msg) {
					$("#msg").html(msg);
                    window.location.reload();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$("#msg").html("<span style='color:red;'>" + textStatus + " " + errorThrown + "</span>");
				}
			});
		} else {
			$("#msg").html('<span style="color:red;">Pilih minimal satu baris</span>');
		    }
	    });
        
    });
</script>

<script defer>
    $('#table').DataTable({
    'responsive': true,
    'autoWidth': true,
    });
</script>