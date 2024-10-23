<form method="POST" action="{{ route('registration') }}" enctype="multipart/form-data">
    @csrf
    <!-- Name -->
    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" required>
    </div>
    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
    </div>
    <!-- Mobile -->
    <div>
        <label for="mobile">Mobile</label>
        <input id="mobile" type="text" name="mobile" required>
    </div>
    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>
    <button type="submit">Register</button>
</form>