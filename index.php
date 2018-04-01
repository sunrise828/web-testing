<?php
$link = mysql_connect('localhost', 'root', 'apmsetup');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db = mysql_select_db('hello', $link);
if(!$db) 
	if (mysql_create_db('hello', $link)) $db = mysql_select_db('hello');
	else die('Could not select db');

$req = htmlspecialchars($_GET["options"]);
$result = mysql_query("SELECT * FROM colors ORDER BY name;");
$rows = mysql_fetch_array($result);

if ($req == 'votes') {
	$result = mysql_query("SELECT votes FROM votes where color='".$_GET["color"]."' ORDER BY city;");
	$rows = mysql_fetch_array($result);
	echo json_encode($rows);
	return;
}
<?>
<html>
<head>
	<title>testing</title>
	<script src='jquery.js'></script>
	<style>
		thead td {
			text-align:center;
			background-color: #336699;
			font-color: white
		}
		tbody td {
			text-align:center;
			background-color: #f9fafb;
		}
		tbody td:odd {
			background-color: #ced7e0;
		}
	</style>
</head
<body>
	<table>
		<thead>
			<th>
				<td>
					Colors
				</td>
				<td>
					Votes
				</td>
			</th>
		</thead>
		<tbody>
			<?php
				foreach ($rows as $key => $value) {
					<?>
					<tr>
						<td class="link">
							<?php
							echo $value;
							<?>
						</td>
						<td>
						</td>
					</tr>
					<?php>
				}
			<?>
		</tbody>
	</table>
	<script>
		$(".link").click(function() {
			var color = $(this).html();
			$.get('index.php/?options=votes&color=' + color, function(data) {
				if (data.length > 0) {
					for(i=0; i<data.length; i++) {
						var obj = data[i];
						$(".link").get(i).html(obj.votes);	
					}					
				}
			});
		});
	</script>
</body>
</html>

