<form name="request-form" action="/request" method="post">

	<label for="name">
		<span class="label">Name</span>
		<input id="name" type="text" name="name" size="20" tabindex="1" maxlength="50"/>
	</label>

	<label for="email">
		<span class="label">Email Address</span>
		<input id="email" type="text" name="email" size="20" tabindex="2" maxlength="50"/>
	</label>

	<label for="message">
		<span class="label">Message</span>
		<textarea id="message" name="message" rows="7" cols="10" tabindex="3" wrap="soft"></textarea>
	</label>

	<div class="button">
		<input id="submit" type="submit" name="submit" value="Click to send" />
	</div>

	<input type="hidden" name="formid" value="request-form" class="hidden" />
</form>