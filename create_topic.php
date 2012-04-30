<h2> Create a new Topic </h2>
<form id="newTopic" method="post" action="add_topic.php"  autocomplete="off">
	<fieldset>
		<label for="subject">Subject: </label>
		<input type="text" id="subject" name="subject" required />
	
		<label for="message">Message: </label>
		<textarea name="message" required="required"></textarea>
		
		<label for="username">Username: </label>
		<input type="text" id="username" name="username" required />
	
		<input type="submit" value="Add topic" />  
	</fieldset>
</form>

