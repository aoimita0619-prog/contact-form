# アプリケーション概要
　お問い合わせフォーム

 　　ユーザーは管理者に商品やショップ等についてのお問い合わせをフォームから送信することができる。<br>
   　管理者はアカウントを作成し、ユーザーから送られてきたお問い合わせの一覧を見ることができる。
# 環境構築
1.お問い合わせフォーム用ディレクトリの作成、移動<br>
    mkdir contact-form<br>
    cd contact-form<br>
  2.お問い合わせフォームをクローン<br>
  　git clone https://github.com/aoimita0619-prog/contact-form.git<br>
  3.ディレクトリの移動<br>
    cd contact-form<br>
  4.パッケージをインストール（改行しない）<br>
  　docker run --rm \\
    -u "$(id -u):$(id -g)" \\
    -v "$(pwd):/var/www/html" \\
    -w /var/www/html \\
    laravelsail/php82-composer:latest \\
    composer install\\<br>
  5.環境ファイルを作成<br>
    cp .env.example .env<br>
  6.laravel sailを起動<br>
    ./vendor/bin/sail up -d<br>
  7.アプリケーションキーを生成<br>
  　./vendor/bin/sail artisan key:generate<br>
　8.データベースのマイグレーションとシーダーを実行<br>
   ./vendor/bin/sail artisan migrate --seed<br>
# 実行環境
  ・PHP 8.2<br>
・laravel 10.50.2<br>
  ・MySQL8.4<br>
  ・nginx1.21.1<br>
# ER図
　<img width="561" height="711" alt="ER" src="https://github.com/user-attachments/assets/7201054b-6106-43eb-8604-368c41835e2d" />

# URL
  ・お問い合わせフォーム:http://localhost/<br>
  ・管理者ログイン画面:http://localhost/login<br>
  ・管理者ユーザー登録画面:http://localhost/register<br>
  ・phpMyAdmin:http://localhost:8080/
 
    
