<?php
	/*
		sForum Pagination for viewtopic
	*/
	
	//Previous link
	if($current_page != 1) 
	{
		echo '<a href="viewtopic.php?id=' . $topicid . '&start=' . ($start - $display) . '&p=' . $pages . '">Previous </a>';
	}
	
	//Numbered pages
	for($i=1; $i<=$pages; $i++) 
	{
		if($current_page != $i) 
		{
			echo '<a href="viewtopic.php?id=' . $topicid . '&start=' . (($display * ($i-1))) . '&p=' . $pages . '"> ' . $i . ' </a>';
		}
		else
		{
			echo $i . ' ';
		}
	}
	
	//Next link
	if($current_page != $pages) {
		echo '<a href="viewtopic.php?id=' . $topicid . '&start=' . ($start + $display) . '&p=' . $pages . '"> Next</a>';
	}
?>
