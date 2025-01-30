<?php
/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************/
class VTExpressionTreeNode{
	function __construct($arr){
		$this->arr = $arr;
	}

	function getParams(){
		$arr = $this->arr;
		return array_slice($arr, 1, sizeof($arr)-1);
	}

	function getName(){
		return $this->arr[0];
	}
}

// Added to support &&, || condition 
class VTIFConditionNode{
    public $cond = array();
    function __construct($arr){
		$this->arr = $arr;
    }
    
    function exec($params, $glue){
        $lhv = $params[0];
        $rhv = $params[1];
        if($glue == 'and'){
            return ($lhv && $rhv);
        } else if($glue == 'or'){
            return ($lhv || $rhv);
        }
    }
}

class VTExpressionSymbol{
	function __construct($value){
		$this->value = $value;
	}

	function __toString(){
		return "VTExpressionSymbol({$this->value})";
	}
}

class VTExpressionParser{
	function __construct($tokens){
		$this->tokens = $tokens;
		$this->tokenQueue = array();
	}

	function nextToken(){
		if(sizeof($this->tokenQueue)==0){
			return $this->tokens->nextToken();
		}else{
			return array_shift($this->tokenQueue);
		}
	}

	function la($n = 1){
		for($i=sizeof($this->tokenQueue); $i<$n; $i++){
			$token = $this->tokens->nextToken();
			$this->tokenQueue[] = $token;
		}
		return $this->tokenQueue[$n-1];
	}

	function consume($label, $value){
		$nextToken=$this->nextToken();
		$token = $this->tokenTolowerCase($nextToken);
		if($token->label!=$label || $token->value!=$value){
			//echo "Was expecting a $label of value $value got a {$token->label} of {$token->value} instead.";
			throw new Exception("Was expecting a $label of value $value got a {$token->label} of {$token->value} instead.");
		}
	}

	function consumeSymbol($sym){
		$this->consume('SYMBOL', new VTExpressionSymbol($sym));
	}


	function check($token, $label, $value){
		return $token->label == $label && $token->value==$value;
	}

	function checkSymbol($token, $sym){
		return $this->check($token, 'SYMBOL', new VTExpressionSymbol($sym));
	}

	function atom(){
		$token = $this->nextToken();
		switch($token->label){
			case "STRING":
				return $token->value;
			case "INTEGER":
				return $token->value;
			case "FLOAT":
				return $token->value;
			case "SYMBOL":
				return $token->value;
			case "OPEN_BRACKET":
				$val = $this->expression();
				$close = $this->nextToken();
				if($close->label != 'CLOSE_BRACKET'){
					throw new Exception("Was expecting a close bracket");
				}
				return $val;
			default:
				throw new Exception();
		}
	}

	function ifCondition(){
		$this->consumeSymbol('if');
		$cond = $this->expression();
        
        // After "if" clause, if we find any conditions with and/or joins then initialize VTIFConditionNode with data
        while(!$this->checkSymbol($this->la(), 'then')) {
            $next = $this->la();
            $condArr[] = array('base', $cond);
			$la = $this->tokenTolowerCase($next);
            if($this->checkSymbol($la, 'and')) {
                $this->consumeSymbol('and');
                $condArr[] = array('and', $this->expression());
            } else if($this->checkSymbol($la, 'or')){
                $this->consumeSymbol('or');
                $condArr[] = array('or', $this->expression());
            } else if($this->checkSymbol($la, 'if')){
                $this->ifCondition();
            } else {
                break;
            }
            $cond = new VTIFConditionNode($condArr);
        }
        // End
        
		$this->consumeSymbol('then');
		$ifTrue = $this->expression();
		$this->consumeSymbol('else');
		$nextla = $this->tokenTolowerCase($this->la());
		if($this->checkSymbol($nextla, 'if')){
			$ifFalse = $this->ifCondition();
		}else{
			$ifFalse = $this->expression();
			$this->consumeSymbol('end');
		}
		return new VTExpressionTreeNode(array(new VTExpressionSymbol('if'), $cond, $ifTrue, $ifFalse));
	}

	function expression(){
		$la1 = $this->la(1);
		$la2 = $this->la(2);
		$la1 = $this->tokenTolowerCase($la1);
        if($this->checkSymbol($la1, 'if')){
			return $this->ifCondition();
		}else if($la1->label=='SYMBOL' && $la2->label=='OPEN_BRACKET'){
			$arr = array($this->nextToken()->value);
			$this->nextToken();
			if($this->la()->label != 'CLOSE_BRACKET'){
				$arr[] = $this->expression();
				$comma = $this->nextToken();
				while($comma->label == 'COMMA'){
					$arr[] = $this->expression();
					$comma = $this->nextToken();
				}
				if($comma->label != 'CLOSE_BRACKET'){
					throw new Exception("Was expecting a closing bracket");
				}
			}else{
				$this->consume('CLOSE_BRACKET', new Symbol(')'));
			}
			return new VTExpressionTreeNode($arr);
		}else{
			return $this->binOp();
		}
	}

	var $precedence = array(
		array('*', '/'),
		array('+', '-'),
		array('and', 'or'),
		array('==','!=','>=', '<=', '>', '<')		
	);
	
	function binOp(){
		return $this->binOpPrec(sizeof($this->precedence)-1);
	}
	
	/**
	 * In case when user gives expression symbol in uppercase like:- IF/AND/OR then since we are comparing expression objects in check() API
	 * it will result in false. So for condition comparators only we should change the expression token value to lowercase and compare.
	 */
	function tokenTolowerCase($token) {
		$value = $token->value->value;
		$conditionSymbols = array('if', 'then', 'else', 'and', 'or', 'end');
		if(in_array(strtolower($value), $conditionSymbols)) {
			$token->value->value = strtolower($value);
		}
		return $token;
	}

	private function binOpPrec($prec){
		if($prec>=0){
			$lhs = $this->binOpPrec($prec-1);
			$la = $this->la();
			if($la->label == 'OPERATOR' && in_array($la->value->value, $this->precedence[$prec])){
				$operator = $this->nextToken()->value;
				$rhs = $this->binOpPrec($prec);
				return new VTExpressionTreeNode(array($operator, $lhs, $rhs));
			}else{
				return $lhs;
			}
		}else{
			return $this->unaryOp();
		}
	}

	function unaryOp(){
		$la = $this->la();
		if($la->label=="OPERATOR" && in_array($la->value->value, array('+', '-'))){
			$token = $this->nextToken();
			$operator = $la->value;
			$operand = $this->unaryOp();
			return new VTExpressionTreeNode(array($operator, $operand));
		}else{
			return $this->atom();
		}
	}
}
?>