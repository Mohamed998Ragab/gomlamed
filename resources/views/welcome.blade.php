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

    <form action="{{ route('addRegister') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">
            Name
        </label>
        <input type="text" name="name" placeholder="name" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        
        <label for="email">
            Email
        </label>
        <input type="email" name="email" placeholder="email" required>
        @error('email')
            <div>{{ $message }}</div>
        @enderror
        
        <label for="image">
            image
        </label>
        <input type="file" name="image">
        
        <label for="phone">
            phone
        </label>
        <input type="text" name="phone" placeholder="phone" required>
        @error('phone')
            <div>{{ $message }}</div>
        @enderror
        
        <label for="password">
            password
        </label>
        <input type="password" name="password" placeholder="password" required>
        @error('password')
            <div>{{ $message }}</div>
        @enderror
        
        <label for="password_confirmation">
            Confirm Password
        </label>
        <input type="password" name="password_confirmation" placeholder="confirm password" required>
        @error('password_confirmation')
            <div>{{ $message }}</div>
        @enderror
        
        <br><br>
        <button type="submit">Register</button>
    </form>
    
</body>

</html>
