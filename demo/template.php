<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<title>Username generator</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
	
	<!-- Hightlight.js -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github-gist.min.css" />
	<style>pre > code { background: transparent !important; padding: 0px !important; }</style>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="page">
		<div class="jumbotron">
			<div class="container">
				<h1>Username generator</h1>
				<p>A simple script to generate usernames based on a name and year of birth.</p>
				<h3>Project information</h3>
				<p>For more information see here: <a href="https://docs.google.com/a/walnuts.milton-keynes.sch.uk/document/d/1v7t2QAVZ6jyMPziN0SOP5QAoi9J4L4KoRDfibv6XCUg/edit?usp=sharing">Programming Project Paperwork: Username generator on Google Docs</a>.</p>
			</div>
		</div>
		<div class="container">
			<h2>Usage</h2>
			<p>You can use this on its own:</p>
			<pre><code class="language-php">$usernamegenerator = new UsernameGenerator();
$username = $usernamegenerator->createNew($name, $dateofbirth);
</code></pre>
			<p>The <code>createNew</code> function takes those two arguments: <code>$name</code> and <code>$dateofbirth</code>. <code>$name</code> should be a string containing a name, for example, "Samuel Elliott". <code>$dateofbirth</code> can contain either a UNIX timestamp or any date string recognised by <a href="https://php.net/strtotime"><code>strtotime</code></a>.</p>
			<p>You can also extend it. You could do this in a large or public application to check if a username already exists.
			<pre><code class="language-php">class MyUsernameGenerator extends UsernameGenerator {
	public function isUnique($username) {
		// Check if this username exists in the database
		// ...
		if(is_object($user_row))
			return true;
		else return false;
	}
}
</code></pre>
			<p>This lets the class know if a username already exists, and it can then re-generate the username.</p>
			<h3>Return values</h3>
			<p>On success, a username in the format: "SaElliott2001" will be returned. If the <code>$name</code> argument contained multiple names (for example "Samuel Thomas Elliott") a string in the format "STElliott2001" will be used. If the username already exists "." and a number will be appended to the username (for example "SaElliott2011.2"). An <code>Exception</code> object will be thrown on an error.</p>
		</div>
		<div class="container">
			<?php
				foreach($messages as $message)
					echo "<p class=\"alert alert-" . htmlentities($message["type"]) . "\">" . $message["message"] . "</p>";
			?>
		</div>
		<div style="background-color: #eeeeee;">
			<div class="container">
				<h2>Demo</h2>
				<form class="form-horizontal" action="<?php echo htmlentities($_SERVER["REQUEST_URI"]); ?>" method="POST">
					<div class="form-group">
						<label class="control-label col-sm-2" for="demo-name">Name</label>
						<div class="col-sm-10">
							<input class="form-control" id="demo-name" name="name" type="text" placeholder="" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="demo-dateofbirth">Date of birth</label>
						<div class="col-sm-10">
							<input class="form-control" id="demo-dateofbirth" name="dateofbirth" type="date" placeholder="" />
							<p class="help-block">This can be a number or anything accepted by PHP's <a href="https://php.net/strtotime"><code>strtotime</code></a> function.</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button class="btn btn-default" type="submit">Generate</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="container">
			<footer class="footer">
				<p>Samuel Elliott 2017 <a href="https://github.com/thewalnutspi/username-generator">https://github.com/thewalnutspi/username-generator</a>.</p>
			</footer>
		</div>
	</div>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- Highlight.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
