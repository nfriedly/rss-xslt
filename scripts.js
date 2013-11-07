// if the html content is escaped, unescape it. also, wrap it in a paragraph tag if necessary....
$(function(){
	var escaped = new RegExp('&[0-9a-z#]{2,6}','i'); // was '&'+'lt;','ig'
	var paragraph = new RegExp('<p','i');
	$('div.post-content').each(function(){
		if(this.innerHTML.match(escaped)) this.innerHTML = this.innerText || this.textContent;
		if(!this.innerHTML.match(paragraph)) $(this).wrap("<p></p>");
	});
});