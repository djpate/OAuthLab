<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link media="screen" rel="stylesheet" type="text/css" href="css/960.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" ></script>
	</head>
	<body>
		<div class="container_12">
			<div class="grid_12">
				<fieldset>
					<legend>Général</legend>
					<form id="general">
						<label>Consumer key</label>
						<input type="text" name="consumer_key" id="consumer_key" />
						<label>Consumer secret</label>
						<input type="text" name="consumer_secret" id="consumer_secret" />
					</form>
				</fieldset>
			</div>
			<div class="grid_6">
				<fieldset>
					<legend>Request token</legend>
					<form id="req_token" onsubmit="return false">
						<input type="hidden" name="action" value="get_request_token" />
						<label>Request token url</label>
						<input type="text" name="url" />
						<button class="submit">Get a request token</button>
					</form>
				</fieldset>
				<fieldset>
					<form id="acc_token" onsubmit="return false">
						<legend>Access token</legend>
						<input type="hidden" name="action" value="get_access_token" />
						<label>Access token url</label>
						<input type="text" name="url" /><br />
						<label>Request Token</label>
						<input type="text" name="token" /><br />
						<label>Request Secret</label>
						<input type="text" name="secret" /><br />
						<label>Verifier</label>
						<input type="text" name="verifier" /><br />
						<button class="submit">Get a access token</button>
					</form>
				</fieldset>
				<fieldset>
					<form onsubmit="return false">
						<legend>Query</legend>
						<input type="hidden" name="action" value="query" />
						<label>Query url</label>
						<input type="text" name="url" /><br />
						<label>Token</label>
						<input type="text" name="token" /><br />
						<label>Secret</label>
						<input type="text" name="secret" /><br />
						<button class="submit">Get a request token</button>
					</form>
				</fieldset>
			</div>
			
			<div class="grid_6">
				<fieldset>
					<legend>Output</legend>
					<div id="log"></div>
				</fieldset>
			</div>
		</div>
		<script>
			$(".submit").click(function(){
				$.post("ajax.php",$(this).parent().serialize()+"&consumer_key="+$("#consumer_key").val()+"&consumer_secret="+$("#consumer_secret").val(),function(data){
					$("#log").html(data);
				});
			});
		</script>
	</body>
</html>