if (top.location == self.location) top.location.href = "/";
function document.onkeydown()
{ 
	if ( event.keyCode==116) 
	{ 
		event.keyCode = 0; 
		event.cancelBubble = true; 
		return false; 
	}
}


