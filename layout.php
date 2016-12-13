<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="en"/>
		<title>Condition Evaluator</title>
		<link href="<? echo $cheeseUrl; ?>css/style.css" rel="stylesheet" title="Default" type="text/css" />
		<link href="<? echo $baseUrl; ?>style.css" rel="stylesheet"/>
	</head>
	<body>
		<div id="document">
			<h1>
				<a href="<? echo $baseUrl; ?>" title="Condition Evaluator">Condition Evaluator</a>
			</h1>
			<dl id="result" class="result<?php echo (string)$result; ?>">
				<dt>
					Result
				</dt>
				<dd>
					<?php echo $result === TRUE ? 'True' : 'False'; ?>
				</dd>
			</dl>
			<fieldset>
				<form action="<? echo $baseUrl; ?>" method="get">
					<dl>
						<dt>
							Values
						</dt>
						<dd>
							<table>
								<tr>
									<th>
										Variable
									</th>
									<th>
										Value
									</th>
								</tr>
<?php for ($i = 0; $i <= 2; $i++): ?>
								<tr>
									<th>
										<input type="text" name="keys[<?php echo $i; ?>]" value="<?php echo $keys[$i]; ?>"/>
									</th>
									<td>
										<input type="text" name="values[<?php echo $i; ?>]" value="<?php echo $values[$i]; ?>"/>
									</td>
								</tr>
<?php endfor; ?>
							</table>
						</dd>
						<dt class="separate">
							Condition
						</dt>
						<dd>
							<textarea id="condition" name="condition"><?php echo $condition; ?></textarea>
						</dd>
					</dl>
					<p>
						<input class="button" type="submit" value="Submit"/>
					</p>
					<dl>
						<dt class="separate">
							Examples
						</dt>
						<dd>
							<ul id="examples">
<?php foreach ($examples as $label => $example): ?>
								<li>
									<a href="<? echo $baseUrl; ?>?condition=<?php echo urlencode($example['condition']); ?>&amp;<?php if (isset($example['keys']) && isset($example['values'])): ?><?php foreach ($example['keys'] as $i => $key): ?>keys[<?php echo $i; ?>]=<?php echo urlencode($key); ?>&amp;<?php endforeach; ?><?php foreach ($example['values'] as $i => $value): ?>values[<?php echo $i; ?>]=<?php echo urlencode($value); ?>&amp;<?php endforeach; ?><?php endif; ?>"><?php echo $label; ?></a>
								</li>
<?php endforeach; ?>
							</ul>
						</dd>
					</dl>
				</form>
			</fieldset>
		</div>
	</body>
</html>