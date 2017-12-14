  <div class="container-fluid">
  <div class="row">
	<table class="table-responsive table-body">
		<thead>		
			<tr>
				<td>No.</td>
	<!-- 			<td>ID</td>
				<td>Nama</td>
 -->				<td>Author</td>
				<td>Title</td>
				<td>Description</td>
				<td>Url</td>
				<td>UrlToImage</td>
				<td>PublishedAt</td>
			</tr>
		</thead>
		<?php
		$no = 1;
		foreach($content as $key => $val){ ?>
		<tbody>		
			<tr>
				<td><?= $no++?></td>
<!-- 				<td><?php echo $val['source']['id'];?></td>
				<td><?php echo $val['source']['name'];?></td> -->
				<td><?php echo $val['author'];?></td>
				<td><?php echo $val['title'];?></td>
				<td><?php echo $val['description'];?></td>
				<td><a href="<?php echo $val['url'];?>"> <?php echo $val['url'];?></a></td>
				<td><img src="<?php echo $val['urlToImage'];?>" height="30;" width="30"></td>
				<td><?php echo $val['publishedAt'];?></td>
			</tr>
		</tbody>
		<?php
		}
		?>
</table>
</div>	
</div>