# ZfcUserSubstitute
It's like the su command for ZfcUser &amp; ZF3.

## Installation
In your `modules.config.php`, set up
```php
'ZfcUser', 'ZfcUserSubstitute'
```

Then, when logged in, hit the following URI:
```
/admin/user/substitute/<existing user ID>
```
Ensure the above is locked down with access controls!
  
  
Then, to exit, hit the following URI:
```
/admin/user/unsubstitute
```


You can put this exit on the UI as follows:
```php
<?php if ($this->originalIdentity()): ?>
<a href="<?php echo $this->url('zfcusersubstitute/unsubstitute') ?>">Back to original user</a>
<?php endif; ?>
```
