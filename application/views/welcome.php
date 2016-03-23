<div id="body">
	<form method="post">
		<select  id="Periods" name="periods_dropdown">
			{periods}
			<option value="{code}">{period}</option>
			{/periods}
		</select>
		 
		<select  id="Day" name="days_dropdown">
			{days}
			<option value="{code}">{day}</option>
			{/days}
		</select>


		<input type='submit' value='Search'>
	</form>
</div>

