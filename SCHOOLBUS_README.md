# SCHOOLBUS PJ

## mail Serverについて
docker内「mailhog」を使用します。

## 設定について
envファイルに以下の記載があることを確認します
```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="schoolbus_test@tegos.co.jp"
MAIL_FROM_NAME="${APP_NAME}"
```
※ 「MAIL_FROM_ADDRESS」は適当です

※ 「MAIL_USERNAME」はnullでも記述しておいてください。必要です。



## mailhogのテストの仕方
1. `{root}./vendor/bin/sail shell`で中に入る
2. `php artisan tinker`でlaravelの対話シェルを起動する
3. `Mail::raw('test email body', function ($email) { $email->to('hoge@piyo.com')->subject('test email subject'); });
   `を実行する
4. `=> Illuminate\Mail\SentMessage {#4700}`が表示されるはず（エラーが出なかったらOK）
5. [http://localhost:8025/](http://localhost:8025/)にログインする（httpsでないことに注意）
6. 上記コマンドで送信したメールが表示されていることを確認する

### 以上
