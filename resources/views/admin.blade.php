<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Copse&display=swap" rel="stylesheet">
</head>

<body>
  <header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/">
          FashionablyLate
        </a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
             <button type="submit" class="header-logout__btn">Logout</button>
       </form>
      </div>
  </header>
  <main>
    <div class="admin__content">
      <div class="admin__heading">
        <h2>Admin</h2>
      </div>
      <div class="search-form_all">
      <form class="search-form" action="/search" method="get">
        @csrf
        <div class="admin__group-content">
           <div class="admin__input--search">
            <input class="admin-form__item-input" type="text" name="keyword" placeholder="例:名前やメールアドレスを入力してください"/>
           </div>
           <div class="admin__input--select">
            <select class="admin-form__item-select" name="gender">
              <option value="" disabled selected>性別</option>
              <option name="gender" value="1">男性</option>
              <option name="gender" value="2">女性</option>
              <option name="gender" value="3">その他</option>
            </select>
           </div>
           <div class="admin__input--select">
             <select class="admin-form__item-select" name="category_id">
               <option value="" disabled selected>お問い合わせの種類</option>
               @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->content }}</option>
               @endforeach
             </select>
            </div>
          <div class="admin__input--date">
            <input class="admin-input__date-select" type="date" name="date">
          </div>
          <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
          </div>
        </div>
      </form>
      <form class="reset-form" action="/reset">
         @csrf
          <div class="reset-form__button">
            <button class="reset-form__button-submit" type="submit" >リセット</button>
          </div>
      </form>
      </div>
       <div class="pagination">
       {{ $contacts->links() }}
      </div>
      <form action="/export" method="GET">
        @csrf
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <button class="export__button" type="submit">エクスポート</button>
      </form>
       <div class="contact-table">
        <table class="contact-table__inner">
          <tr class="contact-table__row">
            <th class="contact-table__header">お名前</th>
            <th class="contact-table__header">性別</th>
            <th class="contact-table__header">メールアドレス</th>
            <th class="contact-table__header">お問い合わせの種類</th>
            <th class="contact-table__header"></th>
          </tr>
          @foreach ($contacts as $contact)
            <tr class="contact-table_row">
                <td class="contact-table__item">
                  <input type="hidden" name="name" value="{{ $contact->last_name}} {{ $contact['first_name'] }}" readonly />
                  <p>{{ $contact->last_name}} {{ $contact->first_name }}</p>
                </td>
                <td class="contact-table__item">
                  <input type="hidden" name="gender" value="{{ $contact->gender }}" readonly/>
                @if( $contact['gender'] == '1')
                <p>男性</p>
                @elseif($contact['gender'] == '2')
                <p>女性</p>
                @else
                <p>その他</p>
                @endif
                </td>
                <td class="contact-table__item">
                  <input type="hidden" name="email" value="{{ $contact->email }}" readonly />
                  <p>{{ $contact->email }}</p>
                </td>
                <td class="contact-table__item">
                 <input type="hidden" name="category_id" value="{{ $contact->category_id }}" readonly />
                 <p>{{ $contact->category->content }}</p>
                </td>
                <td>
                  <form class="detail-form">
                    @csrf
                    <div class="detail-form__button">
                      <button class="open__modal" type="button"
                          data-id="{{ $contact->id }}"
                          data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                          data-gender="{{ $contact->gender }}"
                          data-email="{{ $contact->email }}"
                          data-tel="{{ $contact->tel }}"
                          data-address="{{ $contact->address }}"
                          data-building="{{ $contact->building }}"
                          data-category="{{ $contact->category->content }}"
                          data-detail="{{ $contact->detail }}">詳細</button>
                    </div>
                  </form>
                </td>
            </tr>
          @endforeach
        </table>
       </div>
    </div>

  <!-- ここにモーダルを追加 -->
   <div id="modal" class="modal">
    <div class="modal__content">
        <span id="close__modal" class="close">&times;</span>
      <div class="modal__table">
          <table class="modal-table__inner">
            <tr class="modal-table__row">
              <th class="modal-table__header">お名前</th>
              <td class="modal-table__text">
                <input type="text" name="name" id="modal__name"/>
              </td>
            </tr>
            <tr class="modal-table__row">
              <th class="modal-table__header">性別</th>
              <td class="modal-table__text">
                <p id="modal__gender"></p>
              </td>
            </tr>
            <tr class="modal-table__row">
              <th class="modal-table__header">メールアドレス</th>
              <td class="modal-table__text">
                <p id="modal__email"></p>
              </td>
            </tr>
            <tr class="modal-table__row">
              <th class="modal-table__header">電話番号</th>
              <td class="modal-table__text">
                <input type="tel" name="tel" id="modal__tel" readonly />
              </td>
            </tr>
            <tr class="modal-table__row">
              <th class="modal-table__header">住所</th>
              <td class="modal-table__text">
                <p id="modal__address"></p>
              </td>
            </tr>
            <tr class="modal-table__row">
              <th class="modal-table__header">建物名</th>
              <td class="modal-table__text">
                <input type="text" name="building" id="modal__building" readonly />
              </td>
            </tr>
            <tr class="modal-table__row">
              <th class="modal-table__header">お問い合わせの種類</th>
              <td class="modal-table__text">
                <p id="modal-category_id"></p>
              </td>
            </tr>
            <tr class="modal-table__row">
              <th class="modal-table__header">お問い合わせ内容</th>
              <td class="modal-table__text">
                <p id="modal__detail" readonly></p>
              </td>
            </tr>
          </table>
          <form class="delete-form" action="/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
              <input type="hidden" name="id" id="modal-contact__id">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </form>
    </div>
</div>
  </main>
</body>
</html>

<script>
const modal = document.getElementById('modal');
const closeBtn = document.getElementById('close__modal');

document.querySelectorAll('.open__modal').forEach(button => {

    button.addEventListener('click', function() {

      console.log(this.dataset.name);

        document.getElementById('modal__name').value =
            this.dataset.name;
        
        document.getElementById('modal__tel').value =
            this.dataset.tel;

        document.getElementById('modal__email').textContent =
            this.dataset.email;

        document.getElementById('modal__address').textContent =
            this.dataset.address;

        document.getElementById('modal__building').value =
            this.dataset.building;

        document.getElementById('modal__detail').textContent =
            this.dataset.detail;

        document.getElementById('modal__gender').textContent =
            this.dataset.gender == 1 ? '男性'
            : this.dataset.gender == 2 ? '女性'
            : 'その他';

        document.getElementById('modal-category_id').textContent =
            this.dataset.category;

        document.getElementById('modal-contact__id').value =
            this.dataset.id;

        modal.style.display = 'block';
    });

});

closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});
</script>