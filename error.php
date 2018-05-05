<?php 
switch($data['error'])
	{
	case 0:		$data['error']='Unknown error occured.';break;
	case 1:		$data['error']='Please sepcify your ISD code';break;
	case 2:		$data['error']='Please sepcify your mobile number';break;
	case 3:		$data['error']='Invalid ISD code';break;
	case 4:		$data['error']='Invalid mobile number';break;
	case 5:		$data['line']=isset($data['line'])?' (Line:'.$data['line'].')':'';
				$data['error']='Server error:('.$data['line'].')';
				unset($data['line']);
				break;
	case 6:		$data['error']='Your account is blocked';break;
	case 7:		require('posttime.php');
				$data['time']=isset($data['time'])?' for '.posttime($data['time'],true).'.':'.';
				$data['error']='Your account is freezed'.$data['time'];
				unset($data['time']);
				break;
	case 8:		$data['error']='Could not receive your number. Please refresh the page and try again.';break;
	case 9:		$data['error']='Message could not be sent. Please try after 30 mins';break;
	case 10:	$data['error']='Please enter your code then continue.';break;
	case 11:	$data['left']=(isset($data['left']))?'. Chance left: '.$data['left'].'.':'.';
				$data['error']='Code did not match. Try again'.$data['left'];
				unset($data['left']);
				break;
	case 12:	$data['error']='Please enter username.';break;
	case 13:	$data['error']='Please enter password.';break;
	case 14:	$data['error']='Please enter password in confirm password.';break;
	case 15:	$data['error']='Password is too short.(Min 6 characters).';break;
	case 16:	$data['error']='Password is too long.(Min 24 characters).';break;
	case 17:	$data['error']='Retyped password does not match with actuall password.';break;
	case 18:	$data['error']='Username cannot contain characters other than alphabets, numbers and symbols like .(dot) and _(underscore).';break;
	case 19:	$data['error']='Username has been taken. Try something else.';break;
	case 20:	$data['error']='No account exits with this username. Try signing up';break;
	case 21:	$data['left']=(isset($data['left']))?'. Chance left: '.$data['left'].'.':'.';
				$data['error']='Password did not match. Try again'.$data['left'];
				unset($data['left']);
				break;
	case 22:	$data['error']='Code validity got expired. Try now.';break;
	
	}
$data['error']=htmlentities($data['error']);
?>