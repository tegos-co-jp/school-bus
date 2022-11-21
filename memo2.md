# Markdownの書き方
  https://help.docbase.io/posts/13697

# vee-validate　一覧
https://vee-validate.logaretm.com/v4/guide/global-validators
--------------------------------------------------------------------

### ホームまで戻る　
    cd ~
###　ファイルまで行く
    cd Documents/develop/SAW/school-bus 
### Dockerの起動
    ./vendor/bin/sail up -d
### Dockerの中に入る
    ./vendor/bin/sail shell

--------------------------------------------------------------------

## マスタ　CRUD 作成
### laravelモデルの複数形の調査
    php artisan tinker
    echo Str::plural('schoolYear')
#### ↑school_year スネークケースはキャメルケースにして打つ↑
    exit

### モデル、ファクトリー、マイグレーション、コントロラーファイルの作成
    php artisan make:model SchoolYear -a
#### ↑school_year スネークケースはキャメルケースにして打つ↑

### routes 編集
### app/database/migrations 編集

### テーブル 作成
    php artisan migrate

### app/Http/Models 編集
### app/Http/Controllers 編集
### app/Http/Requests(Store|Update) 編集

### Resources 作成
    php artisan make:Resource SchoolYearResource

### app/Http/Resources 編集

## resources　作成 (resources/Pages/SchoolYear/
##                Create.vue|Edit.vue|Index.vue|Show.vue)

## Create.vue 編集
// import DropdownWithValidation from '@/components/DropdownWithValidation.vue';
### ↑子マスタの場合、なければ追加すること↑
// <DropdownWithValidation name="school_id" :label="labelValues.school_id" :isRequired="true" :options="schools"/>
### ↑親マスタの情報を入力↑

## Edit.vue 編集
// import DropdownWithValidation from '@/components/DropdownWithValidation.vue';
### ↑子マスタの場合、なければ追加すること↑
// <DropdownWithValidation name="school_id" :label="labelValues.school_id" :isRequired="true" :options="schools"/>
### ↑親マスタの情報を入力↑

## Index.vue 編集

## Show.vue 編集

--------------------------------------------------------------------

##　localhost 実行
    npm run dev

--------------------------------------------------------------------

# migrate　一つ戻す
  php artisan migrate:rollback

# route情報　見る
  php artisan route:list

# こけた時 確認するためのプログラム



{{books.data}}
dd($book);
dd('book'data);だったかな？
console.log('masumoto'data); masumotoの部分はブラウザF12の下のとこで検索可能
([])??なんだったっけ
















#### Schema::create('[schools]', function (Blueprint $table) []はテーブル名

# 「school_years」 を作成する時には　「php artisan make:model SchoolYear -a」 で指定する


