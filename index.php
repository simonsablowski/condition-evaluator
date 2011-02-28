<?php
require 'Error.php';
require 'Application.php';
require 'CoachingConfigurator.php';
require 'ConditionEvaluator.php';
?><html>
	<head>
		<title>Condition Evaluator</title>
		<style type="text/css">
		* {
			font-family: arial, sans-serif;
		}
		ul {
			list-style-type: none;
			padding: 0;
		}
		</style>
	</head>
	<body>
		<h1>
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Condition Evaluator</a>
		</h1>
		<div>
			<?php
			$examples = array(
				'Example 1 (valid, true)' => array(
					'keys' => array(
						'var1', 'var2', 'var3'
					),
					'values' => array(
						'1', '2', '0'
					),
					'condition' => "(var1 is 1 or var1 is 'bla') and ('blubb' or var3 gt 5) or var2 is 'hallo'"
				),
				'Example 2 (valid, false)' => array(
					'condition' => "(var1 is 1 or 0) and (1 and (undefined gt 1)) or 0"
				),
				'Example 3 (invalid, false)' => array(
					'condition' => "(var1 is 1 or 'bla') and(1 and('blubb' or b gt 1)) or base64_decode('hallo')"
				),
				'Example 3.1 (getting there, false)' => array(
					'condition' => "(var1 is 1 or 'bla') and (1 and('blubb' or b gt 1)) or base64_decode('hallo')"
				),
				'Example 3.2 (getting there, false)' => array(
					'condition' => "(var1 is 1 or 'bla') and (1 and ('blubb' or b gt 1)) or base64_decode('hallo')"
				),
				'Example 3.3 (valid, true)' => array(
					'condition' => "(var1 is 1 or 'bla') and (1 and ('blubb' or b gt 1)) or base64_decode ('hallo')"
				)
			);
			
			$default = $examples ? pos($examples) : NULL;
			$keys = isset($_REQUEST['keys']) ? $_REQUEST['keys'] : (isset($default['keys']) ? $default['keys'] : array());
			$values = isset($_REQUEST['values']) ? $_REQUEST['values'] : (isset($default['values']) ? $default['values'] : array());
			$condition = isset($_REQUEST['condition']) ? $_REQUEST['condition'] : (isset($default['condition']) ? $default['condition'] : '');
			
			var_dump(str_replace("\r\n", ' ', $condition));
			try {
				$CoachingConfigurator = new CoachingConfigurator;
				var_dump($CoachingConfigurator->setValues(array_combine($keys, $values)));
				
				$ConditionEvaluator = new ConditionEvaluator;
				$ConditionEvaluator->setCoachingConfigurator($CoachingConfigurator);
				var_dump($ConditionEvaluator->evaluate($condition));
			} catch (Error $Error) {
				var_dump($Error->getMessage());
				var_dump($Error->getDetails());
			}
			?>
		</div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" style="position: absolute; top: 0; left: 900px; padding: 0 15px; border: 1px solid grey;">
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
				<textarea name="condition" style="width: 300px; height: 100px;"><?php echo $condition; ?></textarea><br/>
				<input type="submit" name="submit" value="Submit"/>
			</div>
			<h2>
				Examples
			</h2>
			<ul>
				<?php foreach ($examples as $label => $example): ?>
				<li>
					<a href="<?php echo $_SERVER['PHP_SELF']; ?>?condition=<?php echo urlencode($example['condition']); ?>&amp;<?php if (isset($example['keys']) && isset($example['values'])): ?><?php foreach ($example['keys'] as $i => $key): ?>keys[<?php echo $i; ?>]=<?php echo urlencode($key); ?>&amp;<?php endforeach; ?><?php foreach ($example['values'] as $i => $value): ?>values[<?php echo $i; ?>]=<?php echo urlencode($value); ?>&amp;<?php endforeach; ?><?php endif; ?>"><?php echo $label; ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</form>
		<div style="position: absolute; bottom: 0; width: 800px; height: 400px; overflow: scroll; border: 1px solid grey;">
			<?php highlight_file('ConditionEvaluator.php'); ?>
		</div>
	</body>
</html>