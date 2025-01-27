<div class="card">
    <div class="card-body">
        <h1>Greetings from AJM website</h1>

        <p>
            Welcome, {{ $user->name }}! <br>

        </p>

        <p>
            Email: {{ $user->email }}<br>
            Gender: {{ $user->gender }}<br>
            Account Created: {{ $user->created_at }} ({{ $user->created_at->diffForHumans() }})
        </p>
        <p>
            You received this email as a result of your registration to our web site.
            Please click on the verification link to verify your account.
            If this account is not verifying within 7days/1 week your account registration will be deleted to the admin.
        </p>

        <p>
            <b><a href="{{ url('/verification/' . $user->remember_token . '/' . $user->id) }}">Click here to verify your account</a></b>
        </p>
    </div>
</div>
