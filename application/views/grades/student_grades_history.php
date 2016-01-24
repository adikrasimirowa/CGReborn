<?php
if(empty($student_grades_list))
{
	echo'<h4> Няма намерени оценки за този ученик!</h4>';
}else
{
	//TODO - fix the cyrillic that comes from the $_GET
	//echo "<div> Ученик: $student_names</div>";
	//echo "<div> ДОИ: $doi_name </div>";
	echo '<table border="1">
		<tr>
			<th> Дата </th>
			<th> Оценка </th>
		</tr>';
	foreach ($student_grades_list as $value) {
		echo "<tr>
			<td> $value[date_created]</td>
			<td> $value[grade]</td>
		</tr>";
	}

	echo '</table>';
}
