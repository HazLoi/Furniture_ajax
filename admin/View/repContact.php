<form class="formRepContact" method="post">
	<a href="index.php?action=admin-page&act=contactList" class="btn btn-primary">Quay lại</a>
	<hr>
	<div class="row">
		<div class="col-lg-4 col-md-12 col-sm-12 m-auto">
		<input type="hidden" value="<?= $_GET['maLH'] ?>" name="maLH">
			<div class="form-group">
				<label for="authorSend">Người gửi:</label>
				<input class="form-control" value="<?php echo $author ?>" type="text" name="authorSend" readonly>
			</div>


			<div class="form-group">
				<label for="email">Email:</label>
				<input class="form-control" value="<?php echo $email ?>" type="text" name="email" readonly>
			</div>


			<div class="form-group">
				<label for="subject">Chủ đề:</label>
				<input class="form-control" value="<?php echo $subject ?>" type="text" name="subject" readonly>
			</div>

			<div class="form-group">
				<label>Nội dung:</label>
				<input type="hidden" value="<?= $content ?>" name="content" id="content">
				<?= $content ?>
			</div>

			<div class="form-group">
				<label for="repcontent">Trả lời:</label>
				<input type="text" autocomplete="off" spellcheck="false" name="repcontent" id="noteInvoice">
			</div>

			<button class="btn btn-primary">Trả lời tin nhắn</button>
		</div>
	</div>
</form>