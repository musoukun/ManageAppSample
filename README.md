学習のためと、システムのリプレースなどを行うときに、便利なアイデアをためておくために作成しました。

Laravelで作ってます。

### ①画面フォームの入力項目をコンポーネント化しました。
（input、selectbox、checkbox、datepicker等）

### ②テスト自動化（UnitTest）を行いました。
futureテスト、Unitテストの2種類のテストコードを作成しました。下記を確認しました。

テストデータはテスト用DBに、Fakerを利用してダミーデータを作成して、Transaction内で実行し、rollbackする形で実行していました。

- データの検索、登録、更新、削除のメソッドごとのテスト。

~~Viewのテスト（検索時に、画面にデータが表示される事。画面遷移した際に想定したデータが引き継がれて表示されていること。）~~

~~Validationのテスト。（登録、更新時に、指定した項目のバリデーションが通るパターンと、通らないパターンの2種類を確認しました）~~

### ③ドメインデータ駆動設計（DDD）をほんの少し取り入れました。
関心ごとにクラスを分けるようにしました。

### ④リプレイス効率化のため、LaravelでDBの情報を読み取り、必要なクラスをリバースして作成するツールを作成しました。

システムの機能に必要な下記の6種類のファイルをコマンドから自動生成し、簡単な管理画面を自動作成することができます。
※ほかにも実務では作成できるクラスファイルを増やして作っていました。

- FormRequest
- Entity
