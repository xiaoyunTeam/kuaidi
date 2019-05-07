# XiaoYun/kuaidi - 快递100查询扩展包

📦 集成「快递100」快递查询接口，并统一调用方式。


**注意：本扩展包内所有快递公司名称，均不带结尾 `物流` / `快递` / `快运` / `速递` / `速运` 等字眼。**


## 使用方法

### 0. 安装

```bash
composer require xiaoyun/kuaidi
```

### 1. 查询

```php
$kuaidi = new \XiaoYun\Kuaidi(
    '运单编号', 
    '快递公司名称'
);
```

「快递100」支持自动识别，可不填快递公司名称。

### 2. 查询

```php
(new \XiaoYun\Trackers\Kuaidi100)->track($kuaidi);
```

推荐使用「快递100」。



实际项目中，可自行封装辅助函数以便于使用。
