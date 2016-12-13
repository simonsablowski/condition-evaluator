<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="en"/>
		<title>Condition Evaluator</title>
		<link href="<? echo $cheeseUrl; ?>css/style.css" rel="stylesheet" title="Default" type="text/css" />
		<link href="<? echo $baseUrl; ?>css/style.css" rel="stylesheet" title="Default" type="text/css" />
	</head>
	<body>
		<h1>
			<a href="<?php echo $self; ?>">Condition Evaluator</a>
		</h1>
		<div id="result" class="result<?php echo (string)$result; ?>">
			<?php var_dump($result); ?>
		</div>
		<form id="form" action="<?php echo $self; ?>" method="get">
			<h2>
				Values
			</h2>
			<ul>
				<?php for ($i = 0; $i <= 2; $i++): ?>
				<li>
					$<input type="text" name="keys[<?php echo $i; ?>]" value="<?php echo $keys[$i]; ?>"/>
					= <input type="text" name="values[<?php echo $i; ?>]" value="<?php echo $values[$i]; ?>"/>
				</li>
				<?php endfor; ?>
			</ul>
			<h2>
				Condition
			</h2>
			<div>
				<textarea id="condition" name="condition"><?php echo $condition; ?></textarea><br/>
				<input type="submit" value="Submit"/>
			</div>
			<h2>
				Examples
			</h2>
			<ul id="examples">
				<?php foreach ($examples as $label => $example): ?>
				<li>
					<a href="<?php echo $self; ?>?condition=<?php echo urlencode($example['condition']); ?>&amp;<?php if (isset($example['keys']) && isset($example['values'])): ?><?php foreach ($example['keys'] as $i => $key): ?>keys[<?php echo $i; ?>]=<?php echo urlencode($key); ?>&amp;<?php endforeach; ?><?php foreach ($example['values'] as $i => $value): ?>values[<?php echo $i; ?>]=<?php echo urlencode($value); ?>&amp;<?php endforeach; ?><?php endif; ?>"><?php echo $label; ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</form>
		<div id="code">
			<?php echo $code; ?>
		</div>
	</body>
</html>