
<div class="container">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">Search</span>
			<input type="text" name="search_text" id="search_text" placeholder="Search by the user" class="form-control">
		</div>
	</div>
	<br/>
		<div id="result"></div>
</div>

<script>
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var txt = $(this).val();
			if (txt != '') 
				{
					$('#result').html('');
				$ajax({
					url:"user.php",
					method:"post",
					data:{search:txt},
					datatype:"text",
					success:function(data)
					{
						$('#result').html(data);
					}
				});
				}
			else
			{
				$('#result').html('');
				$ajax({
					url:"user.php",
					method:"post",
					data:{search:txt},
					datatype:"text",
					success:function(data)
					{
						$('#result').html(data);
					}
				});
			}
		});
	});
</script>