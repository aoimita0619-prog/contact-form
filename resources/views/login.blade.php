<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Copse&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
     <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">
          FashionablyLate
        </a>
          <div class="header-register">
             <a href="/register" class="header-register__btn">register</a>
          </div>
      </div>
     </div>
    </header>
    <main>
      <div class="login__heading">
        <h2>Login</h2>
      </div>
      <div class="form-login">
       <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="例:test@example.com">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required placeholder="例:coachtech1106">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">ログイン</button>
      </form>
    </div>
    </main>
</body>
</html>