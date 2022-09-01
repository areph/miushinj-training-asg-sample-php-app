## EC2 Auto Scaling Sample PHP Application

### 目的

- URLにアクセスすると下記の情報が見れるPHPアプリケーション
    - 動作しているEC2インスタンスのIDが確認できる
    - 動作しているEC2インスタンスのAZが確認できる
- リクエストの負荷が高まるとEC2 Auto ScalingによってEC2インスタンスがスケールする
- ダッシュボードで確認したり、マルチAZで動作していることがわかる