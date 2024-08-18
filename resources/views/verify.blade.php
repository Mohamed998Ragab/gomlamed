<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Or squad is a digital marketing agency & Media house.
     Our squad is your in-house team of experts that provides creative
      solutions for the long-term development of your business. Our priority
       is to guarantee an effective communication with your business as we believe
        that it is the reason of our success." >
    <title>Gomla</title>
</head>

<style>
    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
</style>

<body>

    <form method="POST" action="{{ route('verification.verify') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required autofocus>
        </div>
        <div>
            <label for="code">Verification Code</label>
            <input id="code" type="text" name="code" required>
        </div>
        <button type="submit">Verify</button>
    </form>
    <br> <br> 
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <input type="hidden" name="email" value="{{ old('email') }}">
        <button type="submit">Resend Verification Code</button>
    </form>
    
    
    
</body>

</html>

