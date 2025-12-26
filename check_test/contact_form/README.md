# お問い合わせフォーム

確認テスト1回目

## 環境構築

1. リポジトリをcloneする
   `git clone git@github.com:Natsuki-abc/CoachTech.git`
2. DockerDesktop アプリを立ち上げる
3. `make init`

> _Mac の M1・M2 チップの PC の場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。\
> エラーが発生する場合は、docker-compose.yml ファイルの「mysql」内に「platform」の項目を追加で記載してください_

```bash
mysql:
    platform: linux/x86_64 // この行を追加
    image: mysql:8.0.26
    environment:
```

## 権限エラー系解消コマンド

```
# UnexpectedValueException
docker compose exec php chown -R www-data:www-data storage

# 保存エラーが出るとき
sudo chown -R $USER:$USER .
```

## 使用技術(実行環境)

- PHP 8.1.34
- Laravel 8.83.8
- MySQL 8.0.26

## ER 図

TODO
< - - - 作成したER図の画像 - - - >

## URL

- 開発環境：http://localhost:8000/
- phpMyAdmin:：http://localhost:8081/
