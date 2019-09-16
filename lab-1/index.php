<?php
	for ($x = 0; $x <= 10; $x++) {
	   echo "The number is: $x <br>";
	}	 
	$days = ["Mon", "Tue", "Wed"];
	echo "Wow $days[0] is over! <br>";

	echo "Length ".count($days);

	$schedule = ["Mon" => "8.00", "Tue" => "10.00"];
	echo "wake up at " . $schedule['Mon']."<br>";

	foreach($schedule as $key => $value) {
		echo "Key=" . $key . ", Value=" . $value;
		echo "<br>";
	 }
	 
?>
