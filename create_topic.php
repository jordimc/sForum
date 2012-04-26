<div id="newTopic">
	<form id="newTopic" method="post" action="add_topic.php"  autocomplete="off">
		<label>Subject: </label>
		<input type="text" id="subject" name="subject" required> <br>
		<label>Message: </label>
		<textarea name="message" rows="5" cols="30" required="required"></textarea> <br>
		<label>Username: </label>
		<input type="text" id="username" name="username" required> <br>
		<input type="submit" value="Add topic" />  
	</form>
</div>
