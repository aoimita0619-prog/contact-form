<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
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
          <div class="header-login">
             <a href="/login" class="header-login__btn">login</a>
          </div>
      </div>
     </div>
    </header>
    <main>
     <div class="register">
      <div class="register__heading">
        <h2>Register</h2>
      </div>
      <div class="form-register">
        <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="例:山田　太郎">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="例:test@example.com">
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
       <button type="submit">登録</button>
     </form>
     </div>
    </div>
    </main>

</body>
</html>