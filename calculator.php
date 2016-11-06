<!DOCTYPE html>
<html>
<body>

<h1>CS143 PHP Calculator</h1>

<h2>Type your expression in the following box: </h2>

<form method="GET">
	<input type="text" name="expression">
	<input type="submit" value="Calculate">
</form>

<h3>Result: </h3>

<?php
// for debugging only
// ini_set('display_errors', 'On');

$expression = $_GET["expression"];

// error messages
define("EXPRESSION_HAS_PARENTHESES_ERROR_MESSAGE", "<font color='red'>Invalid expression: this calculator currently do not support parentheses in an expression.</font>");
define("EXPRESSION_INVALID_ERROR_MESSAGE", "<font color='red'>Invalid expression: please enter a valid mathematical expression.</font>");
define("UNABLE_TO_EVALUATE_EXPRESSION_ERROR_MESSAGE", "<font color='red'>Unable to evaluate the expression.</font>");

// regex patterns
define("CONTAINS_PARENTHESES_PATTERN", "/[\(\)]+/");
define("VALID_EXPRESSION_PATTERN", "/^([-+]?[0-9]*\.?[0-9]+[\/\+\-\*])+([-+]?[0-9]*\.?[0-9]+)$/");
define("SINGLE_NUMBER_EXPRESSION_PATTERN", "/^([-+]?[0-9]*\.?[0-9]+)$/");

if (!is_null($expression) && !empty($expression)){
	
	$resultMessage = "No Result";

	// expression contains brackets
	if(preg_match(CONTAINS_PARENTHESES_PATTERN, $expression)){
		$resultMessage = EXPRESSION_HAS_PARENTHESES_ERROR_MESSAGE;
	}

	elseif(preg_match(SINGLE_NUMBER_EXPRESSION_PATTERN, $expression)){
		$resultMessage = $expression;
	}
	// not a valid mathematical expression
	elseif(!preg_match(VALID_EXPRESSION_PATTERN, $expression)){
		$resultMessage = EXPRESSION_INVALID_ERROR_MESSAGE;
	}

	// expression is valid
	else{
		$resultMessage = eval('return '.$expression.';');
		if (!is_numeric($resultMessage)){
			$resultMessage = UNABLE_TO_EVALUATE_EXPRESSION_ERROR_MESSAGE;
		}
	}

	echo("Entered expression: <b>" . $expression . "</b><br>");
	echo("Result = <b>" . $resultMessage . "</b>");
}

?>

</body>
</html>