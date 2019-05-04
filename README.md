# XiaoYun/kuaidi - 免费快递查询扩展包

📦 集成「快递100」、「快递网」、「快递鸟」三家快递查询接口，并统一调用方式。


* **目录**
  * [小试牛刀](#小试牛刀)
  * [使用方法](#使用方法)
      * [0. 安装](#0-安装)
      * [1. 创建运单](#1-创建运单)
      * [2. 查询](#2-查询)
      * [3. 获得数据](#3-获得数据)
  * [结语](#结语)
  * [声明](#声明)

## 小试牛刀

**注意：本扩展包内所有快递公司名称，均不带结尾 `物流` / `快递` / `快运` / `速递` / `速运` 等字眼。**

克隆本仓库，并执行 `composer install` 安装所需依赖。

在命令行内运行。

```bash
php examples/index.php <运单编号> [快递公司名称]
```

其中，快递公司名称可省略；效果如下：

![](https://i.loli.net/2018/08/01/5b6180a5e13f0.png)

## 使用方法

### 0. 安装

```bash
composer require xiaoyun/kuaidi
```

### 1. 创建运单

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
(new \XiaoYun\Trackers\Kuaidiwang)->track($kuaidi);
(new \XiaoYun\Trackers\Kuaidiniao('Business ID', 'APP Key'))->track($kuaidi);
```

通常三选一即可，推荐使用「快递100」。

若查询过程出错，或接口返回失败将会抛出 `XiaoYun\TrackingException`。

### 3. 获得数据

```php
// 获取状态，所有状态列表见 `Kuaidi::STATUS_*` 常量。
$kuaidi->getStatus();
// 获取详情，支持直接 foreach / while / 数组下标 形式访问。
$kuaidi->getTraces(); 
```

实际项目中，可自行封装辅助函数以便于使用。
