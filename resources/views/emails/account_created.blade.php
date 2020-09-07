<!DOCTYPE html>
<html>
<body>

<h3>Account pending for approval</h3>
<p>
    Name: {{ $user->name }} <br>
    Email: {{ $user->email }}
</p>
<p><a href="{{ route('admin.user.show', $user->id) }}">Click here to approve</a></p>
</body>
</html>
