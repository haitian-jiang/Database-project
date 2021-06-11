### 爬虫模块

#### 功能

爬取sciencedirect([https://www.sciencedirect.com/](https://www.sciencedirect.com/))上的论文描述部分。





#### 文档

本爬虫使用scrapy框架构建。

介绍scrapy

##### 网页分析

sciencedirect的所有目录位于[https://www.sciencedirect.com/browse/journals-and-books](https://www.sciencedirect.com/browse/journals-and-books)，可以在页面上选择或者通过get方法传参`contentType=JL`获取期刊类别的目录。

