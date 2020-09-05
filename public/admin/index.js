function kttrong($b){
	if($b.length>0){
		return true;
	}
	else
		return false;
}
function ktstr($b){
	$a =/[A-Za-z]+/;
	$kq = $b.match($a);
	if($b==$kq)
		return true;
	else
		return false;
}
function ktemail($b){
	$a =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	$kq = $b.match($a);
	if($kq==$b){
		return true;
	}
	else
		return false;
}
function ktso($b){
	$a = /[0-9]+/;
	$kq = $b.match($a);
	if($b==$kq)
		return true;
	else
		return false;
}
function in_array($arry,$b){
	for($i=0;$i<$a.length;$i++){
		if($b == $a[$i]){
			return true;
		}
	}
	return false;
}
