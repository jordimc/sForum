<h2> Add a reply </h2>
<form id="newReply" method="post" action="add_reply.php"  autocomplete="off">
	<fieldset>
		<label for="message">Message: </label>
		<textarea name="message" required="required"></textarea>
		
		<label for="username">Username: </label>
		<input type="text" id="username" name="username" required />
		
		<input type="hidden" id="topic_id" name="topic_id" value="<?php echo $topicid; ?>">
		
		<input type="submit" value="Add reply" />  
	</fieldset>
</form>

