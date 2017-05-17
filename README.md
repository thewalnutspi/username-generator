Username generator
===

A simple script to generate usernames based on a name and year of birth.

### Project information

For more information see here: [Programming Project Paperwork: Username generator on Google Docs](https://docs.google.com/a/walnuts.milton-keynes.sch.uk/document/d/1v7t2QAVZ6jyMPziN0SOP5QAoi9J4L4KoRDfibv6XCUg/edit?usp=sharing).

Usage
---

You can use this on its own:

```php
$usernamegenerator = new UsernameGenerator();
$username = $usernamegenerator->createNew($name, $dateofbirth);

```

The `createNew` function takes those two arguments: `$name` and `$dateofbirth`. `$name` should be a string containing a name, for example, "Samuel Elliott". `$dateofbirth` can contain either a UNIX timestamp or any date string recognised by [`strtotime`](https://php.net/strtotime).

You can also extend it. You could do this in a large or public application to check if a username already exists.

```php
class MyUsernameGenerator extends UsernameGenerator {
	public function isUnique($username) {
		// Check if this username exists in the database
		// ...
		if(is_object($user_row))
			return true;
		else return false;
	}
}

```

This lets the class know if a username already exists, and it can then re-generate the username.

### Return values

On success, a username in the format: "SaElliott2001" will be returned. If the `$name` argument contained multiple names (for example "Samuel Thomas Elliott") a string in the format "STElliott2001" will be used. If the username already exists "." and a number will be appended to the username (for example "SaElliott2011.2"). An `Exception` object will be thrown on an error.
