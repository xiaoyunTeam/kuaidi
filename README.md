# XiaoYun/kuaidi - 快递100查询扩展包

📦 集成「快递100」快递查询接口，并统一调用方式。


**注意：本扩展包内所有快递公司名称，均不带结尾 `物流` / `快递` / `快运` / `速递` / `速运` 等字眼。**


## 使用方法

### 0. 安装

```bash
composer require xiaoyun/kuaidi
```

### 1. 查询运单进程

```php
$kuaidi = \XiaoYun\Kuaidi100::track(
    '运单编号'
);
```

「快递100」支持自动识别，无需填快递公司名称。

### 2. 查询快递单位名

```php
$kuaidi = \XiaoYun\Kuaidi100::detect(
    '运单编号'
);
```


实际项目中，可自行封装辅助函数以便于使用。
