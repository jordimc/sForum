<?php
	/*
		sForum Pagination
	*/
	
	//Previous link
	if($current_page != 1) 
	{
		echo '<a href="index.php?start=' . ($start - $display) . '&p=' . $pages . '">Previous </a>';
	}
	
	//Numbered pages
	for($i=1; $i<=$pages; $i++) 
	{
		if($current_page != $i) 
		{
			echo '<a href="index.php?start=' . (($display * ($i-1))) . '&p=' . $pages . '"> ' . $i . ' </a>';
		}
		else
		{
			echo $i . ' ';
		}
	}
	
	//Next link
	if($current_page != $pages) {
		echo '<a href="index.php?start=' . ($start + $display) . '&p=' . $pages . '"> Next</a>';
	}
?>
