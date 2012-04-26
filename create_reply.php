<div id="newReply">
	<form id="newReply" method="post" action="add_reply.php"  autocomplete="off">
		<label>Username: </label>
		<input type="text" id="username" name="username" required> <br>
		<label>Message: </label>
		<textarea name="message" rows="5" cols="30" required="required"></textarea> <br>
		<input type="hidden" id="topic_id" name="topic_id" value="<?php echo $topicid; ?>">
		<input type="submit" value="Add reply" />  
	</form>
</div>
